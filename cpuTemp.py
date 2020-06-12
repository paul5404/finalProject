from gpiozero import CPUTemperature
from time import sleep, strftime, time
import matplotlib.pyplot as plt

cpu = CPUTemperature()
plt.ion()
x = []
y = []

def write_temp(temp):
    with open("/home/pi/final/cpu_temp.csv", "a") as log:
        log.write("{0},{1}\n".format(strftime("%Y-%m-%d %H:%M:%S"),str(temp)))

def graph(temp):
    plt.title("CPU temperature graph")
    y.append(temp)
    plt.ylabel("CPU Temperature")
    x.append(time())
    plt.xlabel("Time")
    plt.clf()
    plt.scatter(x,y)
    plt.plot(x,y)
    plt.draw()

while True:
    temp = cpu.temperature
    write_temp(temp)
    graph(temp)
    plt.pause(3)
    if(temp > 65):
        print("Temperature Too high")
        break