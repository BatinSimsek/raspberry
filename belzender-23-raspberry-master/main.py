import RPi.GPIO as GPIO
import time
import subprocess
import requests
import mysql.connector
from datetime import datetime

#npm install is required
#npm install ewlink-api is required

database = mysql.connector.connect(
    host="localhost",
    user="user",
    password="welkom123",
    database="deurbel"
)

cursor = database.cursor()

GPIO.setmode(GPIO.BCM)

#De GPIO pin waaraan een van de draden hangt, de andere moet op ground
SENSOR_PIN = 18

sensorValue = None
oldSensorValue = None
#delay van 20 seconden wanneer er wordt aangebeld
delay = 20000
lampDelay = 10000
detectionTime =108

isLampOn = 0

#De magneetsensor instellen
GPIO.setup(SENSOR_PIN, GPIO.IN, pull_up_down=GPIO.PUD_UP)
#url voor de API call
url = "http://145.49.144.108/api/doorbell"

def apiCall():
    try:
        response = requests.post(url)

    #Status code 200 betekent dat de API call goed ging
        if response.status_code == 200:
            print("POST request successful")
        else:
            #Hier gaat de API call fout, We willen zien welke code het is zodat we weten wat er fout gaat
            print(f"POST request failed with status code: {response.status_code}")
            print(response.text)

    except Exception as e:
        print(f"An error occurred: {e}")

def millis():
    #Millis gebruiken we om een delay bij te houden
    return time.time() * 1000

while True:
    if isLampOn == 1 and millis() - detectionTime >= lampDelay:
        isLampOn = 0
        print("Lamp uit")
        #subprocess.run(["node", "Lamp-Project/Lamp.js"])

    #Sensorvalues vergelijken met elkaar, zijn ze niet gelijk dan triggert de sensor
    oldSensorValue = sensorValue
    sensorValue = GPIO.input(SENSOR_PIN)

    if (sensorValue and (sensorValue != oldSensorValue)):
        print("test")

    #Dit wordt getriggerd wanneer de magneten tegen elkaar aangaan
    elif (sensorValue != oldSensorValue and millis() - detectionTime >= delay):
        #Hier wordt millis gebruikt om de delay te starten
        detectionTime = millis()
        #SQL statement maken en de values assignen
        sql = "INSERT INTO logs (id, description, processed, created_at, updated_at) VALUES (%s, %s, %s, %s, %s)"
        value = (0, "Er wordt aangebeldt!", 0, datetime.now(), datetime.now())
        #De functionaliteit van de lamp aanspreken
        #Je spreek de functie 2x aan om hem aan en uit te zetten
        #subprocess.run(["node", "Lamp-Project/Lamp.js"])
        isLampOn = 1
        #Database statement klaarzetten en zenden
        cursor.execute(sql, value)
        database.commit()
        #API call maken om de pop-up op de website te tonen
        apiCall()
        print("Er wordt aangebeld!")
    #kleine delay voor stabiliteit
    time.sleep(0.1)
