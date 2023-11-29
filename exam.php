------------------------------------------------------------------------------------------------------------------
                                    TRANSLATION
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <conio.h>

void drawRectangle(int x, int y, int width, int height) {
    rectangle(x, y, x + width, y + height);
}

void translateRectangle(int &x, int &y, int tx, int ty) {
    x += tx;
    y += ty;
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int x = 100, y = 100;  // Initial position of the rectangle
    int width = 50, height = 30;  // Dimensions of the rectangle

    // Draw the initial rectangle
    drawRectangle(x, y, width, height);
    delay(1000);  // Delay for 1 second

    cleardevice();  // Clear the screen

    // Translate the rectangle and draw it again
    translateRectangle(x, y, 50, 30);  // Translate by (50, 30)
    drawRectangle(x, y, width, height);

    getch();  // Wait for a key press
    closegraph();  // Close the graphics window

    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    ROTATION
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <math.h>

#define PI 3.14159265

void drawRectangle(int x, int y, int width, int height) {
    rectangle(x, y, x + width, y + height);
}

void rotateRectangle(int *x, int *y, int width, int height, float angle) {
    float radians = angle * (PI / 180.0);
    int newX, newY;

    newX = *x + (int)(width * cos(radians) - height * sin(radians));
    newY = *y + (int)(width * sin(radians) + height * cos(radians));

    *x = newX;
    *y = newY;
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int x = 100, y = 100;
    int width = 100, height = 50;

    int angle = 0;

    while (!kbhit()) {
        cleardevice(); // Clears the screen

        drawRectangle(x, y, width, height);

        delay(50); // Introduce a delay for better visualization

        rotateRectangle(&x, &y, width, height, 5); // Rotate the rectangle by 5 degrees

        angle += 5;

        if (angle >= 360)
            angle = 0;
    }

    closegraph();
    return 0;
}

------------------------------------------------------------------------------------------------------------------
                                    SHEARING
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void shear(int vertices[][2], int n, float shx, float shy) {
    for (int i = 0; i < n; i++) {
        int x = vertices[i][0];
        int y = vertices[i][1];
        vertices[i][0] = x + shx * y;
        vertices[i][1] = y + shy * x;
    }
}

void drawObject(int vertices[][2], int n) {
    for (int i = 0; i < n; i++) {
        line(vertices[i][0], vertices[i][1], vertices[(i + 1) % n][0], vertices[(i + 1) % n][1]);
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int n = 4; // Number of vertices of the object
    int vertices[4][2] = {{100, 100}, {200, 100}, {200, 200}, {100, 200}};

    float shx, shy;

    printf("Enter the shearing factor in x (shx): ");
    scanf("%f", &shx);

    printf("Enter the shearing factor in y (shy): ");
    scanf("%f", &shy);

    cleardevice();

    // Draw the original object
    drawObject(vertices, n);

    delay(1000);

    cleardevice();

    // Apply shearing and draw the sheared object
    shear(vertices, n, shx, shy);
    drawObject(vertices, n);

    delay(2000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    SCALING
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void scale(int vertices[][2], int n, float sx, float sy) {
    for (int i = 0; i < n; i++) {
        vertices[i][0] *= sx;
        vertices[i][1] *= sy;
    }
}

void drawObject(int vertices[][2], int n) {
    for (int i = 0; i < n; i++) {
        line(vertices[i][0], vertices[i][1], vertices[(i + 1) % n][0], vertices[(i + 1) % n][1]);
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int n = 4; // Number of vertices of the object
    int vertices[4][2] = {{100, 100}, {200, 100}, {200, 200}, {100, 200}};

    float sx, sy;

    printf("Enter the scaling factor in x (sx): ");
    scanf("%f", &sx);

    printf("Enter the scaling factor in y (sy): ");
    scanf("%f", &sy);

    cleardevice();

    // Draw the original object
    drawObject(vertices, n);

    delay(1000);

    cleardevice();

    // Apply scaling and draw the scaled object
    scale(vertices, n, sx, sy);
    drawObject(vertices, n);

    delay(2000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    REFLECTION OF A TRIANGLE
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void reflect(int vertices[][2], int n, char axis) {
    for (int i = 0; i < n; i++) {
        if (axis == 'x') {
            vertices[i][1] = -vertices[i][1];
        } else if (axis == 'y') {
            vertices[i][0] = -vertices[i][0];
        }
    }
}

void drawTriangle(int vertices[][2]) {
    line(vertices[0][0], vertices[0][1], vertices[1][0], vertices[1][1]);
    line(vertices[1][0], vertices[1][1], vertices[2][0], vertices[2][1]);
    line(vertices[2][0], vertices[2][1], vertices[0][0], vertices[0][1]);
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int vertices[3][2];

    printf("Enter the vertices of the triangle (x, y) :\n");
    for (int i = 0; i < 3; i++) {
        printf("Vertex %d: ", i + 1);
        scanf("%d %d", &vertices[i][0], &vertices[i][1]);
    }

    char axis;
    printf("Enter the reflection axis (x or y): ");
    scanf(" %c", &axis);  // Note the space before %c to consume the newline character.

    cleardevice();

    // Draw the original triangle
    drawTriangle(vertices);

    delay(1000);

    cleardevice();

    // Apply reflection and draw the reflected triangle
    reflect(vertices, 3, axis);
    drawTriangle(vertices);

    delay(2000);

    closegraph();
    return 0;
}

------------------------------------------------------------------------------------------------------------------
                                   DDA Algorithm
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>
#include <math.h>

void drawLineDDA(int x1, int y1, int x2, int y2) {
    int dx = x2 - x1;
    int dy = y2 - y1;

    int steps;
    if (abs(dx) > abs(dy)) {
        steps = abs(dx);
    } else {
        steps = abs(dy);
    }

    float xIncrement = (float)dx / steps;
    float yIncrement = (float)dy / steps;

    float x = x1, y = y1;

    for (int i = 0; i <= steps; i++) {
        putpixel(round(x), round(y), WHITE);
        x += xIncrement;
        y += yIncrement;
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int x1, y1, x2, y2;

    printf("Enter the starting point (x1 y1): ");
    scanf("%d %d", &x1, &y1);

    printf("Enter the ending point (x2 y2): ");
    scanf("%d %d", &x2, &y2);

    cleardevice();

    // Draw the line using DDA algorithm
    drawLineDDA(x1, y1, x2, y2);

    delay(2000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                   Bresenham Algorithm
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void drawLine(int x1, int y1, int x2, int y2) {
    int dx = abs(x2 - x1);
    int dy = abs(y2 - y1);
    int x, y;
    int p;

    int incX, incY, incP;

    if (x2 > x1) {
        incX = 1;
    } else {
        incX = -1;
    }

    if (y2 > y1) {
        incY = 1;
    } else {
        incY = -1;
    }

    x = x1;
    y = y1;

    if (dx > dy) {
        // If the line slope is less than 1
        // Swap dx and dy for octants 2, 6, 3, and 7
        if (dy > dx) {
            int temp = dx;
            dx = dy;
            dy = temp;
            // Swap the increment values
            temp = incX;
            incX = incY;
            incY = temp;
        }

        p = 2 * dy - dx;

        for (int i = 0; i < dx; i++) {
            putpixel(x, y, WHITE);
            delay(10);
            if (p >= 0) {
                y += incY;
                p += 2 * (dy - dx);
            } else {
                p += 2 * dy;
            }
            x += incX;
        }
    } else {
        // If the line slope is greater than or equal to 1
        p = 2 * dx - dy;

        for (int i = 0; i < dy; i++) {
            putpixel(x, y, WHITE);
            delay(10);
            if (p >= 0) {
                x += incX;
                p += 2 * (dx - dy);
            } else {
                p += 2 * dx;
            }
            y += incY;
        }
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int x1, y1, x2, y2;

    printf("Enter the starting point (x1 y1): ");
    scanf("%d %d", &x1, &y1);

    printf("Enter the ending point (x2 y2): ");
    scanf("%d %d", &x2, &y2);

    drawLine(x1, y1, x2, y2);

    delay(5000);

    closegraph();
    return 0;
}

------------------------------------------------------------------------------------------------------------------
                                   Bresenham Ellipse Algorithm
------------------------------------------------------------------------------------------------------------------
#include <stdio.h>
#include <conio.h>
#include <graphics.h>
#include <math.h>
#include <dos.h>
void main()
{
long int d1,d2;
int i,gd=DETECT ,gm,x,y;
long int rx,ry,rxsq,rysq,tworxsq,tworysq,dx,dy;
printf("Enter the x Radius of the ellipse");
scanf("%ld",&rx);
printf("Enter the y Radius of the ellipse");
scanf("%ld",&ry);
initgraph(&gd,&gm," ");
rxsq=rx*rx;
rysq=ry*ry;
tworxsq=2*rxsq;
tworysq=2*rysq;
x=0;
y=ry;
d1=rysq - (rxsq * ry) + (0.25 * rxsq);
dx= tworysq * x;
dy= tworxsq * y;
do
{
  putpixel(200+x,200+y,15);
  putpixel(200-x,200-y,15);
  putpixel(200+x,200-y,15);
  putpixel(200-x,200+y,15);
  if (d1 < 0)
   {
    x=x+1;
    y=y;
     dx=dx + tworysq;
     d1=d1 + dx + rysq;
     }
   else
   {
    x=x+1;
    y=y-1;
    dx= dx + tworysq;
    dy= dy - tworxsq;
    d1= d1 + dx - dy + rysq;
    }
    delay(50);
    }while (dx < dy);
   d2 = rysq * ( x + 0.5) * ( x + 0.5 ) + rxsq * (y - 1) * (y-1) - rxsq * rysq;
    do
    {
     putpixel(200+x,200+y,15);
  putpixel(200-x,200-y,15);
  putpixel(200+x,200-y,15);
  putpixel(200-x,200+y,15);

  if (d2 >0)
  {
  x=x;
  y=y-1;
  dy = dy - tworxsq;
  d2 = d2 - dy + rxsq;
  }
  else
  {
  x= x+1;
  y=y-1;
  dy=dy - tworxsq;
  dx= dx + tworysq;
  d2 = d2 + dx -dy + rxsq;
  }
  delay(50);
} while ( y> 0);
getch();
closegraph();
}

------------------------------------------------------------------------------------------------------------------
                                   MID POINT CIRCLE
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void drawCircle(int xc, int yc, int radius) {
    int x = radius;
    int y = 0;
    int p = 1 - radius;

    // Plot the initial point in each octant
    putpixel(xc + x, yc - y, WHITE);
    putpixel(xc - x, yc - y, WHITE);
    putpixel(xc + y, yc + x, WHITE);
    putpixel(xc - y, yc + x, WHITE);

    // When radius is zero, only a single point will be printed at center
    if (radius > 0) {
        putpixel(xc + y, yc - x, WHITE);
        putpixel(xc - y, yc - x, WHITE);
        putpixel(xc + x, yc + y, WHITE);
        putpixel(xc - x, yc + y, WHITE);
    }

    while (x > y) {
        y++;

        // Mid-point is inside or on the perimeter
        if (p <= 0)
            p = p + 2 * y + 1;

        // Mid-point is outside the perimeter
        else {
            x--;
            p = p + 2 * y - 2 * x + 1;
        }

        // All the perimeter points have already been printed
        if (x < y)
            break;

        // Printing the generated point and its reflection in the other octants
        putpixel(xc + x, yc - y, WHITE);
        putpixel(xc - x, yc - y, WHITE);
        putpixel(xc + y, yc + x, WHITE);
        putpixel(xc - y, yc + x, WHITE);

        if (x != y) {
            putpixel(xc + y, yc - x, WHITE);
            putpixel(xc - y, yc - x, WHITE);
            putpixel(xc + x, yc + y, WHITE);
            putpixel(xc - x, yc + y, WHITE);
        }
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int xc, yc, radius;

    printf("Enter the center of the circle (xc yc): ");
    scanf("%d %d", &xc, &yc);

    printf("Enter the radius of the circle: ");
    scanf("%d", &radius);

    drawCircle(xc, yc, radius);

    delay(5000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                   DISPLAY COLORING TEXT
------------------------------------------------------------------------------------------------------------------
#include <stdio.h>

// Define ANSI escape codes for text color
#define ANSI_COLOR_RED     "\x1b[31m"
#define ANSI_COLOR_GREEN   "\x1b[32m"
#define ANSI_COLOR_YELLOW  "\x1b[33m"
#define ANSI_COLOR_BLUE    "\x1b[34m"
#define ANSI_COLOR_MAGENTA "\x1b[35m"
#define ANSI_COLOR_CYAN    "\x1b[36m"
#define ANSI_COLOR_RESET   "\x1b[0m"

int main() {
    // Display colored text
    printf(ANSI_COLOR_RED "This is red text.\n" ANSI_COLOR_RESET);
    printf(ANSI_COLOR_GREEN "This is green text.\n" ANSI_COLOR_RESET);
    printf(ANSI_COLOR_YELLOW "This is yellow text.\n" ANSI_COLOR_RESET);
    printf(ANSI_COLOR_BLUE "This is blue text.\n" ANSI_COLOR_RESET);
    printf(ANSI_COLOR_MAGENTA "This is magenta text.\n" ANSI_COLOR_RESET);
    printf(ANSI_COLOR_CYAN "This is cyan text.\n" ANSI_COLOR_RESET);

    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                   BASIC SHAPES
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    // Draw a line
    setcolor(RED);
    line(50, 50, 200, 50);

    // Draw a rectangle
    setcolor(GREEN);
    rectangle(50, 80, 200, 150);

    // Draw a circle
    setcolor(BLUE);
    circle(300, 115, 50);

    // Draw an ellipse
    setcolor(YELLOW);
    ellipse(450, 115, 0, 360, 80, 40);

    delay(5000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    ELLIPSE DRAWING ALGORITHM 1
------------------------------------------------------------------------------------------------------------------
// C program for implementing
// Mid-Point Ellipse Drawing Algorithm

#include <stdio.h>

void midptellipse(int rx, int ry, int xc, int yc)
{

	float dx, dy, d1, d2, x, y;
	x = 0;
	y = ry;

	// Initial decision parameter of region 1
	d1 = (ry * ry)
		- (rx * rx * ry)
		+ (0.25 * rx * rx);
	dx = 2 * ry * ry * x;
	dy = 2 * rx * rx * y;

	// For region 1
	while (dx < dy) {

		// Print points based on 4-way symmetry
		printf("(%f, %f)\n", x + xc, y + yc);
		printf("(%f, %f)\n", -x + xc, y + yc);
		printf("(%f, %f)\n", x + xc, -y + yc);
		printf("(%f, %f)\n", -x + xc, -y + yc);

		// Checking and updating value of
		// decision parameter based on algorithm
		if (d1 < 0) {
			x++;
			dx = dx + (2 * ry * ry);
			d1 = d1 + dx + (ry * ry);
		}
		else {
			x++;
			y--;
			dx = dx + (2 * ry * ry);
			dy = dy - (2 * rx * rx);
			d1 = d1 + dx - dy + (ry * ry);
		}
	}

	// Decision parameter of region 2
	d2 = ((ry * ry) * ((x + 0.5) * (x + 0.5)))
		+ ((rx * rx) * ((y - 1) * (y - 1)))
		- (rx * rx * ry * ry);

	// Plotting points of region 2
	while (y >= 0) {

		// printing points based on 4-way symmetry
		printf("(%f, %f)\n", x + xc, y + yc);
		printf("(%f, %f)\n", -x + xc, y + yc);
		printf("(%f, %f)\n", x + xc, -y + yc);
		printf("(%f, %f)\n", -x + xc, -y + yc);

		// Checking and updating parameter
		// value based on algorithm
		if (d2 > 0) {
			y--;
			dy = dy - (2 * rx * rx);
			d2 = d2 + (rx * rx) - dy;
		}
		else {
			y--;
			x++;
			dx = dx + (2 * ry * ry);
			dy = dy - (2 * rx * rx);
			d2 = d2 + dx - dy + (rx * rx);
		}
	}
}

// Driver code
int main()
{
	// To draw a ellipse of major and
	// minor radius 15, 10 centered at (50, 50)
	midptellipse(10, 15, 50, 50);

	return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    ELLIPSE DRAWING ALGORITHM 2
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdlib.h>
#include <stdio.h>

void drawEllipse(int xc, int yc, int rx, int ry) {
    int x = 0, y = ry;
    int p1 = ry * ry - rx * rx * ry + 0.25 * rx * rx;

    while (2 * ry * ry * x <= 2 * rx * rx * y) {
        putpixel(xc + x, yc - y, WHITE);
        putpixel(xc - x, yc - y, WHITE);
        putpixel(xc + x, yc + y, WHITE);
        putpixel(xc - x, yc + y, WHITE);

        x++;

        if (p1 < 0)
            p1 = p1 + 2 * ry * ry * x + ry * ry;
        else {
            y--;
            p1 = p1 + 2 * ry * ry * x - 2 * rx * rx * y + ry * ry;
        }
    }

    int p2 = ry * ry * (x + 0.5) * (x + 0.5) + rx * rx * (y - 1) * (y - 1) - rx * rx * ry * ry;

    while (y >= 0) {
        putpixel(xc + x, yc - y, WHITE);
        putpixel(xc - x, yc - y, WHITE);
        putpixel(xc + x, yc + y, WHITE);
        putpixel(xc - x, yc + y, WHITE);

        y--;

        if (p2 > 0)
            p2 = p2 - 2 * rx * rx * y + rx * rx;
        else {
            x++;
            p2 = p2 + 2 * ry * ry * x - 2 * rx * rx * y + rx * rx;
        }
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    int xc, yc, rx, ry;

    printf("Enter the center coordinates (xc yc): ");
    scanf("%d %d", &xc, &yc);

    printf("Enter the major and minor radii (rx ry): ");
    scanf("%d %d", &rx, &ry);

    drawEllipse(xc, yc, rx, ry);

    delay(5000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    FLOOD FILL ALGORITHM
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdio.h>

void floodFill(int x, int y, int old_color, int new_color) {
    if (getpixel(x, y) == old_color) {
        putpixel(x, y, new_color);

        floodFill(x + 1, y, old_color, new_color);
        floodFill(x - 1, y, old_color, new_color);
        floodFill(x, y + 1, old_color, new_color);
        floodFill(x, y - 1, old_color, new_color);
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    // Draw a boundary for the area to be filled
    rectangle(50, 50, 200, 200);

    // Coordinates of the starting point inside the boundary
    int x = 100, y = 100;

    // Old color of the boundary (WHITE in this case)
    int old_color = WHITE;

    // New color to fill the area (RED in this case)
    int new_color = RED;

    // Call the floodFill function
    floodFill(x, y, old_color, new_color);

    delay(5000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    BOUNDARY FILL ALGORITHM 1(REC)
------------------------------------------------------------------------------------------------------------------
#include <graphics.h>
#include <stdio.h>

void boundaryFill(int x, int y, int fill_color, int boundary_color) {
    if (getpixel(x, y) != boundary_color && getpixel(x, y) != fill_color) {
        putpixel(x, y, fill_color);
        boundaryFill(x + 1, y, fill_color, boundary_color);
        boundaryFill(x - 1, y, fill_color, boundary_color);
        boundaryFill(x, y + 1, fill_color, boundary_color);
        boundaryFill(x, y - 1, fill_color, boundary_color);
    }
}

int main() {
    int gd = DETECT, gm;
    initgraph(&gd, &gm, "C:\\Turboc3\\BGI");

    // Draw a boundary for the area to be filled
    rectangle(50, 50, 200, 200);

    // Coordinates of the starting point inside the boundary
    int x = 100, y = 100;

    // Fill color (GREEN in this case)
    int fill_color = GREEN;

    // Boundary color (WHITE in this case)
    int boundary_color = WHITE;

    // Call the boundaryFill function
    boundaryFill(x, y, fill_color, boundary_color);

    delay(5000);

    closegraph();
    return 0;
}
------------------------------------------------------------------------------------------------------------------
                                    BOUNDARY FILL ALGORITHM 1(CIRC)
------------------------------------------------------------------------------------------------------------------
// C Implementation for Boundary Filling Algorithm 
#include <graphics.h> 

// Function for 4 connected Pixels 
void boundaryFill4(int x, int y, int fill_color,int boundary_color) 
{ 
	if(getpixel(x, y) != boundary_color && 
	getpixel(x, y) != fill_color) 
	{ 
		putpixel(x, y, fill_color); 
		boundaryFill4(x + 1, y, fill_color, boundary_color); 
		boundaryFill4(x, y + 1, fill_color, boundary_color); 
		boundaryFill4(x - 1, y, fill_color, boundary_color); 
		boundaryFill4(x, y - 1, fill_color, boundary_color); 
	} 
} 

//driver code 
int main() 
{ 
	// gm is Graphics mode which is 
	// a computer display mode that 
	// generates image using pixels. 
	// DETECT is a macro defined in 
	// "graphics.h" header file 
	int gd = DETECT, gm; 

	// initgraph initializes the 
	// graphics system by loading a 
	// graphics driver from disk 
	initgraph(&gd, &gm, ""); 

	int x = 250, y = 200, radius = 50; 

	// circle function 
	circle(x, y, radius); 

	// Function calling 
	boundaryFill4(x, y, 6, 15); 

	delay(10000); 

	getch(); 

	// closegraph function closes the 
	// graphics mode and deallocates 
	// all memory allocated by 
	// graphics system . 
	closegraph(); 

	return 0; 
}
------------------------------------------------------------------------------------------------------------------
                                    CLIPPING
------------------------------------------------------------------------------------------------------------------
#include<stdio.h>
#include<conio.h>
#include<graphics.h>
#include<math.h>

#define Round(val)((int)(val+.5))

int maxx, maxy, miny, minx;

void main() {
   int gd = DETECT, gm;
   void clipping(int xa, int ya, int xb, int y);
   int xa, xb, ya, yb;
   printf("Enter the window coordination");
   scanf("%d%d%d%d", &minx, &maxy, &maxx, &miny);
   printf("Enter the two and points for the line");
   scanf("%d%d%d%d", &xa, &ya, &xb, &yb);

   initgraph(&gd, &gm, "");

   rectangle(minx, miny, maxx, maxy);
   line(xa, ya, xb, yb);
   getch();
   closegraph();
}

void clipping(int xa, int ya, int xb, int yb) {

   int Dx = xb - xa, Dy = yb - ya, steps, k;
   int visible1 = 0, visible2 = 0;
   float xin, yin, x = xa, y = ya;

   if (abs(Dx) > abs(Dy))
      steps = abs(Dx);
   else
      steps = abs(Dy);

   xin = Dx / (float) steps;
   yin = Dy / (float) steps;
   putpixel(Round(x), Round(y), 2);

   for (k = 0; k < steps; k++) {
      x += xin;

      y += yin;

      if ((y > miny && y < maxx)) {
         visible1 = 1;
         putpixel(Round(x), Round(y), 2);
      } else
         visible2 = 1;
   }

   if (visible1 == 0)
      outtextxy(20, 200, "complextely visible");

   if (visible1 == 1 && visible2 == 1)
      outtextxy(20, 20, "partialy visible");

   if (visible1 == 1 && visible2 == 0)
      outtextxy(20, 20, "completly visible");
}
