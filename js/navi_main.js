/* 
 * Floor plan navigation prototype / proof-of-concept
 * Copyright (c) 2024 Christian Figge. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

// Controls for changing floor plan view
const btnFloorForward = document.getElementById("btnFloorForward");
btnFloorForward.onclick = () => changeFloor("forward");
const btnFloorRight = document.getElementById("btnFloorRight");
btnFloorRight.onclick = () => changeFloor("right");
const btnFloorLeft = document.getElementById("btnFloorLeft");
btnFloorLeft.onclick = () => changeFloor("left");
const btnFloorBackward = document.getElementById("btnFloorBackward");
btnFloorBackward.onclick = () => changeFloor("backward");
const btnFloorUp = document.getElementById("btnFloorUp");
btnFloorUp.onclick = () => changeFloor("up");
const btnFloorDown = document.getElementById("btnFloorDown");
btnFloorDown.onclick = () => changeFloor("down");

// Navigation controls, client input
const inStart_Floor = document.getElementById("inStart_Floor");
const inStart_Room = document.getElementById("inStart_Room");
const inFinish_Floor = document.getElementById("inFinish_Floor");
const inFinish_Room = document.getElementById("inFinish_Room");
document.getElementById("btnStartNavi").onclick = navigate;

// Other globals 
// (still passing some of them as parameters, so future refactoring is easier)
const ctx = document.getElementById("canvas").getContext("2d"); // context object for drawing
const testOut = document.getElementById("testOut"); // prints for testing
const img = new Image(); // current floor plan image, for ctx.drawImage()
var floorplanData; // associative array of data needed for drawing, fetched onload (see below)
var currentFloorIdx; // index/key for the array above
var nav_trees = []; // array of tree_ids provided by the server
var nav_paths = []; // array of path points (pixel coordinates) provided by the server


window.onload = async function () {
    floorplanData = await getFloorplanData();
    currentFloorIdx = "C0"; //Object.keys(floorplanData)[0];
    updateFloorNavButtons();
    await setCanvasImage(img, ctx, floorplanData[currentFloorIdx]);
    setPathLineStyle(ctx);
}

function setPathLineStyle(ctx) {
    ctx.lineWidth = 4;
    ctx.strokeStyle = 'red';
}

async function getFloorplanData() {
    let resp = await fetch("data/floorplans.json");
    return (await resp.json()).floorplans;
}

function setCanvasImage(imgObj, ctx, floorData) {
    return new Promise ((resolve, reject) => {
        imgObj.onload = () => {
            ctx.drawImage(imgObj, floorData.sX, floorData.sY, floorData.sWidth, floorData.sHeight, 0, 0, ctx.canvas.width, ctx.canvas.height);
            resolve();
        }
        imgObj.src = floorData.imgUrl;
    });
}

// Dis-/Enable view controls for current floor plan
function updateFloorNavButtons() {
    let floorData = floorplanData[currentFloorIdx];
    for (const dir in floorData.directions) {
        let bool = floorData.directions[dir] == -1;
        switch (dir) {
            case "forward": btnFloorForward.disabled = bool; break;
			case "right": btnFloorRight.disabled = bool; break;
			case "backward": btnFloorBackward.disabled = bool; break;
			case "left": btnFloorLeft.disabled = bool; break;
            case "up": btnFloorUp.disabled = bool; break;
            case "down": btnFloorDown.disabled = bool; break;
        }
    }
}

function changeFloor(sDirection) {
    let newFloorIdx = floorplanData[currentFloorIdx].directions[sDirection];
    setFloorFromIdx(newFloorIdx);
}

function setFloorFromIdx(floorIdx) {
    if (floorIdx !== -1) {
        currentFloorIdx = floorIdx;
        const currentFloor = floorplanData[currentFloorIdx];
        updateFloorNavButtons();

        setCanvasImage(img, ctx, currentFloor).then(() => {
            // after the floor plan image has been drawn, iterate over nav_trees
            // to check if there are path's to be drawn on the current floor
            for(let i = 0; i < nav_trees.length; i++) {
                if(currentFloor.tree_ids.includes(nav_trees[i])) {
                    console.log("Drawing path (point coordinates) for tree #" + nav_trees[i] + ":");
                    console.log(nav_paths[i]);
                    drawPathOnFloor(nav_paths[i], img, ctx, currentFloor);
                }
            }
        });
    }
}

function getXMLHttpRequest() {
    var xhr = null;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (typeof ActiveXObject != "undefined") {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
}

function drawPathOnFloor(points, imgObj, ctx, floorData) {
    // Set canvas/img ratios
    const xRatio = ctx.canvas.width / floorData.sWidth;
    const yRatio = ctx.canvas.height / floorData.sHeight;

    // Set drawing offsets, in case of a chopped floor plan image
    const xOffset = floorData.sX;
    const yOffset = floorData.sY;

    ctx.beginPath();
    for (let i = 0; i < points.length - 1; i++) {
        ctx.moveTo((points[i][0] - xOffset) * xRatio, (points[i][1] - yOffset) * yRatio);
        ctx.lineTo((points[i + 1][0] - xOffset) * xRatio, (points[i + 1][1] - yOffset) * yRatio);
    }
    ctx.closePath();
    ctx.stroke();
}

// Send location identifiers to the server, receive paths and draw them
function navigate() {
    testOut.innerHTML = "";
    let strStart_Floor = inStart_Floor.value.trim();
    let strStart = strStart_Floor + "-" + inStart_Room.value.trim();
    let strFinish = inFinish_Floor.value.trim() + "-" + inFinish_Room.value.trim(); 

    if (strStart !== strFinish) {
        let req = getXMLHttpRequest();
        req.onload = () => {
            let resp = req.responseText;
            console.log("Server response: " + resp);
            if (resp.length > 0) {
                let resp_json = JSON.parse(resp);
                nav_trees = resp_json.trees;
                nav_paths = resp_json.paths;
                setFloorFromIdx(strStart_Floor);
            }
            else {
                testOut.innerHTML = "Location not found! Please check your input."
            }
        };
        req.open("POST", "php/getPathPoints.php", true);
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("start=" + strStart + "&finish=" + strFinish);
    }
    else {
        testOut.innerHTML = "Start & Finish locations are equal!";
    }
}