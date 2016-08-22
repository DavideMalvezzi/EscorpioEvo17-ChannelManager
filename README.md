# EscorpioEvo17 Channel Manager
##Introduction
Online app to modify the [EscorpioEvo16-Dashboard](https://github.com/DavideMalvezzi/EscorpioEvo16-Dashboard) and the 
[EscorpioEvo16-OnlineTelemetry](https://github.com/DavideMalvezzi/EscorpioEvo16-OnlineTelemetry) channels settings.

Each channels is described by:
- can id, used to identify the channel on the can bus
- name
- data type (bitflag, signed integer, unsigned integer, decimal or string)
- size, number of bytes expected in each can bus packet for this channel
- minimum value, used if the values has to be in a certain range
- maximum value, used if the values has to be in a certain range
- default value, used in the log file and telemetry if the received value is out of range or the TTL time is finished
- a JavaScript conversion formula used to convert the received values into the desidered value (used in the [EscorpioEvo16-OnlineTelemetry](https://github.com/DavideMalvezzi/EscorpioEvo16-OnlineTelemetry) and in the [EscorpioEvo17-CanAnalyzer](https://github.com/DavideMalvezzi/EscorpioEvo17-CanAnalyzer)). The formula can contain all the mathematical
operator/function used in JavaScript. To refer to the received value inside the formula use the 'x' variable.
- an optional description.

It's possible to add a new channel or remove/edit an existant one.
Also, the CHANNELS.CFG file for the [EscorpioEvo16-Dashboard](https://github.com/DavideMalvezzi/EscorpioEvo16-Dashboard) can be downloaded.
