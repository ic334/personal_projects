from sys import maxsize
import tkinter as tk
import random

zoomFactor = 20
boarderWidth = 75
isVertical = True


def dist(bound1, bound2):
    """distance between two bounds
    """
    return abs(bound1-bound2)


def buildWall(topBound, bottomBound, leftBound, rightBound, isVertical):
    """ newLine input points
    :param topBound: Top Bound (based on y-axis)   
    :param bottomBound: Bottom Bound (based on y-axis)
    :param leftBound: Left Bound (based on x-axis)
    :param rightBound: Right Bound (based on x-axis)
    :param isVertical: Boolean that helps with changing between vertical and horizontal lines
    """

    if (isVertical):
        # return if distance between points equals the zoomFactor
        if (dist(topBound, bottomBound) == zoomFactor or dist(topBound, bottomBound) == 0):
            return

        # Make a vertical line with a gap
        gapStart = random.randrange(topBound, bottomBound, zoomFactor)
        gapEnd = gapStart + zoomFactor

        horCenter = random.randrange(leftBound, rightBound, zoomFactor)
        while (horCenter == leftBound):
            horCenter = random.randrange(leftBound, rightBound, zoomFactor)

        canvas.create_line(horCenter, topBound, horCenter,
                           gapStart, fill='white')
        canvas.create_line(horCenter, gapEnd, horCenter,
                           bottomBound, fill='white')

        isVertical = not isVertical

        base.after(0, buildWall(topBound, bottomBound,
                   leftBound, horCenter, isVertical))
        base.after(0, buildWall(topBound, bottomBound,
                   horCenter, rightBound, isVertical))
    else:
        # return if distance between points equals the zoomFactor
        if (dist(leftBound, rightBound) == zoomFactor or dist(leftBound, rightBound) == 0):
            return

        # Make a horizontal line with a gap
        gapStart = random.randrange(leftBound, rightBound, zoomFactor)
        gapEnd = gapStart + zoomFactor

        vrtCenter = random.randrange(topBound, bottomBound, zoomFactor)
        while (vrtCenter == topBound):
            vrtCenter = random.randrange(topBound, bottomBound, zoomFactor)

        canvas.create_line(leftBound, vrtCenter, gapStart,
                           vrtCenter, fill='white')
        canvas.create_line(gapEnd, vrtCenter, rightBound,
                           vrtCenter, fill='white')

        isVertical = not isVertical

        base.after(0, buildWall(topBound, vrtCenter,
                   leftBound, rightBound, isVertical))
        base.after(0, buildWall(vrtCenter, bottomBound,
                   leftBound, rightBound, isVertical))
    return


print("Enter height>", end=' '),
inputHeight = int(input())
inputHeight *= zoomFactor
print("Enter width>", end=' '),
inputWidth = int(input())
inputWidth *= zoomFactor

base = tk.Tk()
base.title("Random Maze")

canvas = tk.Canvas(base, height=2*boarderWidth+inputHeight,
                   width=2*boarderWidth+inputWidth, bg="#263D42")
canvas.pack()

# used to randomly choose START and FINISH for maze (only evaluates to 0-3 (NOT 4)
case = random.randrange(0, 4, 1)

if (case == 0):  # Starting at the Top-Left corner of the grid
    startLabelTL = canvas.create_text(
        boarderWidth-45, boarderWidth, text="START", anchor="nw", fill='white')

    cursor = canvas.create_oval(
        boarderWidth+5, boarderWidth+5, boarderWidth+15, boarderWidth+15, fill='white')

    finishLabelBR = canvas.create_text(
        boarderWidth+inputWidth+45, boarderWidth+inputHeight, text="FINISH", anchor="se", fill='white')
    # Make maze boarder based on user inputs
    boarder1 = canvas.create_line(boarderWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth+inputHeight-zoomFactor, fill='white')
    boarder2 = canvas.create_line(boarderWidth+inputWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+zoomFactor, fill='white')

elif (case == 1):  # Starting at the Top-Right corner of the grid
    startLabelTR = canvas.create_text(
        boarderWidth+inputWidth+45, boarderWidth, text="START", anchor="ne", fill='white')

    cursor = canvas.create_oval(boarderWidth+inputWidth-15, boarderWidth+15,
                                boarderWidth+inputWidth-5, boarderWidth+5, fill='white')

    finishLabelBL = canvas.create_text(
        boarderWidth-45, boarderWidth+inputHeight, text="FINISH", anchor="sw", fill='white')
    # Make maze boarder based on user inputs
    boarder1 = canvas.create_line(boarderWidth, boarderWidth+inputHeight-zoomFactor,
                                  boarderWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth, fill='white')
    boarder2 = canvas.create_line(boarderWidth+inputWidth, boarderWidth+zoomFactor,
                                  boarderWidth+inputWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+inputHeight, fill='white')

elif (case == 2):  # Starting at the Bottom-Left corner of the grid
    startLabelBL = canvas.create_text(
        boarderWidth-45, boarderWidth+inputHeight, text="START", anchor="sw", fill='white')

    cursor = canvas.create_oval(boarderWidth+5, boarderWidth+inputHeight-5,
                                boarderWidth+15, boarderWidth+inputHeight-15, fill='white')

    finishLabelTR = canvas.create_text(
        boarderWidth+inputWidth+45, boarderWidth, text="FINISH", anchor="ne", fill='white')
    # Make maze boarder based on user inputs
    boarder1 = canvas.create_line(boarderWidth, boarderWidth+inputHeight-zoomFactor,
                                  boarderWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth, fill='white')
    boarder2 = canvas.create_line(boarderWidth+inputWidth, boarderWidth+zoomFactor,
                                  boarderWidth+inputWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+inputHeight, fill='white')

elif (case == 3):  # Starting at the Bottom-Rights corner of the grid
    startLabelBR = canvas.create_text(
        boarderWidth+inputWidth+45, boarderWidth+inputHeight, text="START", anchor="se", fill='white')

    cursor = canvas.create_oval(boarderWidth+inputWidth-15, boarderWidth+inputHeight-15,
                                boarderWidth+inputWidth-5, boarderWidth+inputHeight-5, fill='white')

    finishLabelTL = canvas.create_text(
        boarderWidth-45, boarderWidth, text="FINISH", anchor="nw", fill='white')
    # Make maze boarder based on user inputs
    boarder1 = canvas.create_line(boarderWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth,
                                  boarderWidth+inputWidth, boarderWidth+inputHeight-zoomFactor, fill='white')
    boarder2 = canvas.create_line(boarderWidth+inputWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+inputHeight,
                                  boarderWidth, boarderWidth+zoomFactor, fill='white')

# Use recursion to build the walls of the maze
topBound = boarderWidth
bottomBound = boarderWidth+inputHeight
leftBound = boarderWidth
rightBound = boarderWidth+inputWidth
buildWall(topBound, bottomBound, leftBound, rightBound, isVertical)


def left(event):
    x = -20
    y = 0
    canvas.move(cursor, x, y)


def right(event):
    x = 20
    y = 0
    canvas.move(cursor, x, y)


def up(event):
    x = 0
    y = -20
    canvas.move(cursor, x, y)


def down(event):
    x = 0
    y = 20
    canvas.move(cursor, x, y)


base.bind('<Left>', left)
base.bind('<Right>', right)
base.bind('<Up>', up)
base.bind('<Down>', down)

base.mainloop()

# Notes:
# Make confetti when you win the maze
# Make walls impenetrable
