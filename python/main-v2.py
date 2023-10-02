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

import RPi.GPIO as GPIO
import time
import sys

# Konfigurasi GPIO
PIR_PIN = 17  # Gantilah dengan nomor pin yang Anda gunakan
GPIO.setmode(GPIO.BCM)
GPIO.setup(PIR_PIN, GPIO.IN)

def motion_detected(PIR_PIN):
    print("Motion Detected!")
    
    # Hentikan pendeteksian lebih lanjut
    GPIO.remove_event_detect(PIR_PIN)
    
    # Semua kode Anda yang sebelumnya ada di sini
    # Misalnya, fungsi untuk mengambil gambar, dll.
    # ...
    
    # Kode untuk mengukur dimensi kaki
    # ...
    
    
    
    # Jika Anda ingin menghentikan program setelah menulis ke file
    GPIO.cleanup()
    sys.exit(0)

# Tambahkan event listener untuk sensor PIR
GPIO.add_event_detect(PIR_PIN, GPIO.RISING, callback=motion_detected)

try:
    print("PIR Module Test (CTRL+C to exit)")
    while True:  # loop ini akan berjalan selamanya sampai program dihentikan
        time.sleep(1)

except KeyboardInterrupt:
    print("Quitting")
    GPIO.cleanup()