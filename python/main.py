#-------------------------------
# imports
#-------------------------------

# builtins
import os,sys,time,traceback
from math import hypot

# must be installed using pip
# python3 -m pip install opencv-python
import numpy as np
import cv2

# local clayton libs
import frame_capture
import frame_draw
import time

#-------------------------------
# default settings
#-------------------------------

# camera values
camera_id = 0
camera_width = 1920
camera_height = 1080
camera_frame_rate = 30
#camera_fourcc = cv2.VideoWriter_fourcc(*"YUYV")
camera_fourcc = cv2.VideoWriter_fourcc(*"MJPG")

# auto measure mouse events
auto_percent = 0.2 
auto_threshold = 127
auto_blur = 5

# normalization mouse events
norm_alpha = 0
norm_beta = 255

#-------------------------------
# read config file
#-------------------------------

# you can make a config file "camruler_config.csv"
# this is a comma-separated file with one "item,value" pair per line
# you can also use a "=" separated pair like "item=value"
# you can use # to comment a line
# the items must be named like the default variables above

# read local config values
configfile = 'camruler_config.csv'
if os.path.isfile(configfile):
    with open(configfile) as f:
        for line in f:
            line = line.strip()
            if line and line[0] != '#' and (',' in line or '=' in line):
                if ',' in line:
                    item,value = [x.strip() for x in line.split(',',1)]
                elif '=' in line:
                    item,value = [x.strip() for x in line.split('=',1)]
                else:
                    continue                        
                if item in 'camera_id camera_width camera_height camera_frame_rate camera_fourcc auto_percent auto_threshold auto_blur norm_alpha norm_beta'.split():
                    try:
                        exec(f'{item}={value}')
                        print('CONFIG:',(item,value))
                    except:
                        print('CONFIG ERROR:',(item,value))

#-------------------------------
# camera setup
#-------------------------------

# Inisialisasi kamera
cap = cv2.VideoCapture(camera_id)
cap.set(3, camera_width)  # Set lebar kamera
cap.set(4, camera_height)  # Set tinggi kamera

time.sleep(2)

ret, frame0 = cap.read()
# Menampilkan gambar
cv2.imshow('Captured Frame', frame0)
cv2.waitKey(0)
cv2.destroyAllWindows()

width = camera_width
height = camera_height
area = width * height
cx = int(width/2)
cy = int(height/2)
dm = hypot(cx,cy) # max pixel distance

#-------------------------------
# conversion (pixels to measure)
#-------------------------------

# distance units designator
unit_suffix = 'mm'

# calibrate every N pixels
pixel_base = 10

# maximum field of view from center to farthest edge
# should be measured in unit_suffix 
cal_range = 85

# initial calibration values table {pixels:scale}
# this is based on the frame size and the cal_range
cal = dict([(x,cal_range/dm) for x in range(0,int(dm)+1,pixel_base)])

# calibration loop values
# inside of main loop below
cal_base = 5
cal_last = None

# calibration update
def cal_update(x,y,unit_distance):

    # basics
    pixel_distance = hypot(x,y)
    scale = abs(unit_distance/pixel_distance)
    target = baseround(abs(pixel_distance),pixel_base)

    # low-high values in distance
    low  = target*scale - (cal_base/2)
    high = target*scale + (cal_base/2)

    # get low start point in pixels
    start = target
    if unit_distance <= cal_base:
        start = 0
    else:
        while start*scale > low:
            start -= pixel_base

    # get high stop point in pixels
    stop = target
    if unit_distance >= baseround(cal_range,pixel_base):
        high = max(cal.keys())
    else:
        while stop*scale < high:
            stop += pixel_base

    # set scale
    for x in range(start,stop+1,pixel_base):
        cal[x] = scale
        print(f'CAL: {x} {scale}')

# read local calibration data
calfile = 'camruler_cal.csv'
if os.path.isfile(calfile):
    with open(calfile) as f:
        for line in f:
            line = line.strip()
            if line and line[0] in ('d',):
                axis,pixels,scale = [_.strip() for _ in line.split(',',2)]
                if axis == 'd':
                    # print(f'LOAD: {pixels} {scale}')
                    cal[int(pixels)] = float(scale)

# convert pixels to units
def conv(x,y):

    d = distance(0,0,x,y)

    scale = cal[baseround(d,pixel_base)]

    return x*scale,y*scale

# round to a given base
def baseround(x,base=1):
    return int(base * round(float(x)/base))

# distance formula 2D
def distance(x1,y1,x2,y2):
    return hypot(x1-x2,y1-y2)

# normalize
cv2.normalize(frame0,frame0,norm_alpha,norm_beta,cv2.NORM_MINMAX)

# gray frame
frame1 = cv2.cvtColor(frame0,cv2.COLOR_BGR2GRAY)

# blur frame
frame1 = cv2.GaussianBlur(frame1,(auto_blur,auto_blur),0)

# threshold frame n out of 255 (85 = 33%)
frame1 = cv2.threshold(frame1,auto_threshold,255,cv2.THRESH_BINARY)[1]

# invert
frame1 = ~frame1

# find contours on thresholded image
contours,nada = cv2.findContours(frame1,cv2.RETR_EXTERNAL,cv2.CHAIN_APPROX_SIMPLE)   

# loop over the contours
for c in contours:

    # contour data (from top left)
    x1,y1,w,h = cv2.boundingRect(c)
    x2,y2 = x1+w,y1+h
    x3,y3 = x1+(w/2),y1+(h/2)

    # percent area
    percent = 100*w*h/area
    
    # if the contour is too small, ignore it
    if percent < auto_percent:
            continue

    # if the contour is too large, ignore it
    elif percent > 60:
            continue

    # convert to center, then distance
    x1c,y1c = conv(x1-(cx),y1-(cy))
    x2c,y2c = conv(x2-(cx),y2-(cy))
    xlen = abs(x1c-x2c)
    ylen = abs(y1c-y2c)
    print(xlen)
    print(ylen)
        
    with open("captured_dimensions.txt", "w") as f:
        f.write(f"{xlen:.2f}\n")
        f.write(f"{ylen:.2f}\n")