#!/bin/bash

# Script: raspitemp.sh

# Purpose: Display the Raspberry Pi CPU and GPU  temperature of Raspberry Pi 2/3 

#Author: Shafi-www.shafis.in under GPL v2.x+

#More Details: http://shafis.in/automation/continues...

# -------------------------------------------------------

cpu=$(</sys/class/thermal/thermal_zone0/temp)

echo "$(date) @ $(hostname)"

echo "-------------------------------------------"

echo "GPU => $(/opt/vc/bin/vcgencmd measure_temp)"

echo "CPU => $((cpu/1000))'C"

