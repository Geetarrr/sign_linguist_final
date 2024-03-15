<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HandHunt</title>
  <style>
    body {
      font-family: 'Press Start 2P', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #7335b7; /* Updated background color */
      color: #fff;
    }

    .fade-in {
      animation: fadeInAnimation 1s forwards;
    }

    @keyframes fadeInAnimation {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .container {
      max-width: 620px;
      margin: 50px auto;
     
      border: 5px solid #3498db; /* Border color */
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.1); /* Transparent background */
      position: relative;
    }

    .title {
      text-align: center;
      margin-bottom: 10px;
      font-size: 32px;
    }

    .maze-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .maze-canvas {
      border: 2px solid #fff;
      border-radius: 5px;
    }

    .settings {
      text-align: center;
      position: absolute;
      top: 10px;
      right: 20px;
    }

    .settings label {
      margin-right: 10px;
    }

    .settings input[type="text"],
    .settings input[type="button"] {
      padding: 5px 10px;
      border: 1px solid #fff;
      border-radius: 5px;
      background-color: #000;
      color: #fff;
      transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    .settings input[type="text"]:focus,
    .settings input[type="button"]:hover {
      background-color: #333;
      border-color: #fff;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #666;
    }

    .settings {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      flex-direction: column;
    }

    .input-row {
      display: flex;
      align-items: center;
      margin-bottom: 10px; /* Add spacing between rows */
    }

    .input-row label {
      margin-right: 10px;
    }

    .input-row input[type="text"],
    .input-row input[type="button"] {
      padding: 5px 10px;
      border: 1px solid #fff;
      border-radius: 5px;
      background-color: #000;
      color: #fff;
      transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    .input-row input[type="text"]:focus,
    .input-row input[type="button"]:hover {
      background-color: #333;
      border-color: #fff;
    }
    
    .outer-border {
  border: 5px solid #3498db; /* Border color */
  border-radius: 10px; /* Rounded corners */
  margin: 20px auto; /* Adjust margin for outer box */
  max-width: 690px; /* Adjust as needed */
  padding: 10px 10px 10px 10px; /* Adjust padding for inner box */
  height: 690px; /* Adjust height for outer box */
  background-color: #c24200;
}



  </style>
</head>
<body onload="onLoad();" class="fade-in">
  <div class="outer-border">
    <div class="extra-border">
      <div class="container fade-in">
        <h1 class="title">HandHunt</h1>
        <div class="maze-container fade-in">
          <canvas id="mainForm" class="maze-canvas"></canvas>
        </div>
      </div>
      <div class="settings fade-in" style=";">
        <div class="input-row">
          <label for="cols">Columns:</label>
          <input id="cols" type="text" size="5" value="20" />
        </div>
        <div class="input-row" style="margin-left:14px;">
          <label for="rows">Rows:</label >
          <input id="rows" type="text" size="5" value="20"  style="margin-left:10px;"/>
        </div>
        <div class="input-row" style="margin-left:85px;">
          <input id="generate" type="button" value="Generate" />
        </div>
      </div>
    </div>
  </div>

  <script>
    let ctx;
    let canvas;
    let maze;
    let mazeHeight;
    let mazeWidth;
    let player;

    // Hand class to represent the player
    class Hand {
      constructor() {
        this.col = 0;
        this.row = 0;
      }
    }

    class MazeCell {
      constructor(col, row) {
        this.col = col;
        this.row = row;

        this.eastWall = true;
        this.northWall = true;
        this.southWall = true;
        this.westWall = true;

        this.visited = false;
      }
    }

    class Maze {
      constructor(cols, rows, cellSize) {
        this.backgroundColor = "#ffffff";
        this.cols = cols;
        this.endColor = "#88FF88";
        this.mazeColor = "#000000";
        this.rows = rows;
        this.cellSize = cellSize;

        this.cells = [];

        this.generate();
      }

      generate() {
        mazeHeight = this.rows * this.cellSize;
        mazeWidth = this.cols * this.cellSize;

        canvas.height = mazeHeight;
        canvas.width = mazeWidth;
        canvas.style.height = mazeHeight;
        canvas.style.width = mazeWidth;

        for (let col = 0; col < this.cols; col++) {
          this.cells[col] = [];
          for (let row = 0; row < this.rows; row++) {
            this.cells[col][row] = new MazeCell(col, row);
          }
        }

        let rndCol = Math.floor(Math.random() * this.cols);
        let rndRow = Math.floor(Math.random() * this.rows);

        let stack = [];
        stack.push(this.cells[rndCol][rndRow]);

        let currCell;
        let dir;
        let foundNeighbor;
        let nextCell;

        while (this.hasUnvisited(this.cells)) {
          currCell = stack[stack.length - 1];
          currCell.visited = true;
          if (this.hasUnvisitedNeighbor(currCell)) {
            nextCell = null;
            foundNeighbor = false;
            do {
              dir = Math.floor(Math.random() * 4);
              switch (dir) {
                case 0:
                  if (currCell.col !== (this.cols - 1) && !this.cells[currCell.col + 1][currCell.row].visited) {
                    currCell.eastWall = false;
                    nextCell = this.cells[currCell.col + 1][currCell.row];
                    nextCell.westWall = false;
                    foundNeighbor = true;
                  }
                  break;
                case 1:
                  if (currCell.row !== 0 && !this.cells[currCell.col][currCell.row - 1].visited) {
                    currCell.northWall = false;
                    nextCell = this.cells[currCell.col][currCell.row - 1];
                    nextCell.southWall = false;
                    foundNeighbor = true;
                  }
                  break;
                case 2:
                  if (currCell.row !== (this.rows - 1) && !this.cells[currCell.col][currCell.row + 1].visited) {
                    currCell.southWall = false;
                    nextCell = this.cells[currCell.col][currCell.row + 1];
                    nextCell.northWall = false;
                    foundNeighbor = true;
                  }
                  break;
                case 3:
                  if (currCell.col !== 0 && !this.cells[currCell.col - 1][currCell.row].visited) {
                    currCell.westWall = false;
                    nextCell = this.cells[currCell.col - 1][currCell.row];
                    nextCell.eastWall = false;
                    foundNeighbor = true;
                  }
                  break;
              }
              if (foundNeighbor) {
                stack.push(nextCell);
              }
            } while (!foundNeighbor)
          } else {
            currCell = stack.pop();
          }
        }

        this.redraw();
      }

      hasUnvisited() {
        for (let col = 0; col < this.cols; col++) {
          for (let row = 0; row < this.rows; row++) {
            if (!this.cells[col][row].visited) {
              return true;
            }
          }
        }
        return false;
      }

      hasUnvisitedNeighbor(mazeCell) {
        return ((mazeCell.col !== 0 && !this.cells[mazeCell.col - 1][mazeCell.row].visited) ||
          (mazeCell.col !== (this.cols - 1) && !this.cells[mazeCell.col + 1][mazeCell.row].visited) ||
          (mazeCell.row !== 0 && !this.cells[mazeCell.col][mazeCell.row - 1].visited) ||
          (mazeCell.row !== (this.rows - 1) && !this.cells[mazeCell.col][mazeCell.row + 1].visited));
      }

      redraw() {
        ctx.fillStyle = this.backgroundColor;
        ctx.fillRect(0, 0, mazeHeight, mazeWidth);

        ctx.fillStyle = this.endColor;
        ctx.fillRect((this.cols - 1) * this.cellSize, (this.rows - 1) * this.cellSize, this.cellSize, this.cellSize);

        ctx.strokeStyle = this.mazeColor;
        ctx.strokeRect(0, 0, mazeHeight, mazeWidth);

        for (let col = 0; col < this.cols; col++) {
          for (let row = 0; row < this.rows; row++) {
            if (this.cells[col][row].eastWall) {
              ctx.beginPath();
              ctx.moveTo((col + 1) * this.cellSize, row * this.cellSize);
              ctx.lineTo((col + 1) * this.cellSize, (row + 1) * this.cellSize);
              ctx.stroke();
            }
            if (this.cells[col][row].northWall) {
              ctx.beginPath();
              ctx.moveTo(col * this.cellSize, row * this.cellSize);
              ctx.lineTo((col + 1) * this.cellSize, row * this.cellSize);
              ctx.stroke();
            }
            if (this.cells[col][row].southWall) {
              ctx.beginPath();
              ctx.moveTo(col * this.cellSize, (row + 1) * this.cellSize);
              ctx.lineTo((col + 1) * this.cellSize, (row + 1) * this.cellSize);
              ctx.stroke();
            }
            if (this.cells[col][row].westWall) {
              ctx.beginPath();
              ctx.moveTo(col * this.cellSize, row * this.cellSize);
              ctx.lineTo(col * this.cellSize, (row + 1) * this.cellSize);
              ctx.stroke();
            }
          }
        }

        // Draw hand icon
        const handImg = new Image();
        handImg.src = 'assets/hello (1).png';
        handImg.onload = function() {
          ctx.drawImage(handImg, (player.col * maze.cellSize), (player.row * maze.cellSize), maze.cellSize, maze.cellSize);
        }
      }
    }

    function onClick(event) {
      maze.cols = document.getElementById("cols").value;
      maze.rows = document.getElementById("rows").value;
      maze.generate();
    }

    function onKeyDown(event) {
      switch (event.keyCode) {
        case 37:
        case 65:
          if (!maze.cells[player.col][player.row].westWall) {
            player.col -= 1;
          }
          break;
        case 39:
        case 68:
          if (!maze.cells[player.col][player.row].eastWall) {
            player.col += 1;
          }
          break;
        case 40:
        case 83:
          if (!maze.cells[player.col][player.row].southWall) {
            player.row += 1;
          }
          break;
        case 38:
        case 87:
          if (!maze.cells[player.col][player.row].northWall) {
            player.row -= 1;
          }
          break;
        default:
          break;
      }
      maze.redraw();
    }

    function onLoad() {
      canvas = document.getElementById("mainForm");
      ctx = canvas.getContext("2d");

      player = new Hand(); // Create a new instance of the Hand class
      maze = new Maze(20, 20, 25);

      document.addEventListener("keydown", onKeyDown);
      document.getElementById("generate").addEventListener("click", onClick);
    }
  </script>
</body>
</html>
