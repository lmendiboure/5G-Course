<center> <h1>IoT protocols: Analysis and Implementation</h1> </center>

The idea of this session is to allow you to discover the main communication protocols used in the IoT with a focus on LoRa, LoRaWAN (theoretical analysis for both) and MQTT (simple implementation).

The report you will submit at the end of this session will represent 50% of the final written grade for this module.

Your report should be sent at: *leo.mendiboure@univ-eiffel.fr*

## 1. Radio Access and Network Protocols: A Theoretical Analysis




## 2. Application layer Protocols: Discovering MQTT Through Experiments



##. To Go Further: Implementing End-to-End (E2e) LOR

If you have an end device (or a gateway) that you want to connect to a LoRaWAN network (or even if you don't have any nodes!) open-source and free solutions exist (cf. figure below).

<div style="text-align:center">
  <figure>
      <img src="https://hackster.imgix.net/uploads/attachments/1117892/_la7bfJ4gh4.blob?auto=compress&w=900&h=675&fit=min&fm=jpg" style="float: left; margin-right: 10px;">
      <figcaption>Figure: Example of architecture based on TTN and IoT-LAB (Source: https://www.hackster.io/gianmarcozizzo/aws-based-iot-system-using-riot-os-lorawan-ttn-iot-lab-dae93b)</figcaption>
  </figure>
</div> 

**Q.** What is TTN? What could be its potential applications?

**Q.** What is FIT IoT-LAB? How could it be used?

An implementation of such a solution is presented in this tutorial: https://www.iot-lab.info/legacy/tutorials/riot-ttn/index.html 

*Note:* Be careful, the tutorial presented here is not functional. It is based on version 2 of TTN and evolutions would be necessary if you wanted to implement this solution (current version of TTN is V3).
