<center> <h1>Introduction to IoT</h1> </center>

The idea of this session is to allow you to discover the main communication protocols used in the IoT with a focus on LoRa, LoRaWAN (theoretical analysis for both) and MQTT (simple implementation).

The report you will submit at the end of this session will represent 50% of the final written grade for this module.

Your report should be sent at: *leo.mendiboure@univ-eiffel.fr*

*Note:* For the whole work, except if a specific source is indicated, I suggest you use the following presentation in which you should be able to find the different answers to the questions. However, you are also free to find answers on other sites/sources: https://drive.google.com/file/d/1FYwdOSiN_gk_21IOZij0dzEBA9Bg-u9d/view

*Note:* The answers to the questions should of course be written in English.

## 1. IoT Architecture and Protocols: A Theoretical Analysis (1h30-2h)

### A. IoT Architecture

<div style="text-align:center">
  <figure>
      <img src="https://www.interviewbit.com/blog/wp-content/uploads/2022/06/Different-Layers-Of-IOT-1024x870.png" style="float: left; margin-right: 10px;">
      <figcaption>Figure: Example of IoT Architecture
      </figcaption>
  </figure>
</div> 

**Q.1A1** Considering the above image, indicate what are the main elements of an IoT Architecture. What is the main role of each layer? (there, you could have to use the following source: https://www.interviewbit.com/blog/iot-architecture/)

**Q.1A2** Explain the benefits of Edge Computing compared to traditional Cloud Computing architectures.

### B. Radio Access Technologies for IoT

**Q.1B1** Analysing slide 19, indicate: 1) the most demanding application in terms of latency, 2) in terms of battery life duration, 3) in terms of latency.

**Q.1B2** Using slide 20, name some WPAN standards and some LPWAN standards. What is the difference in terms of communication distance between these solutions?

**Q.1B3** Using slide 22, indicate what the number of connected objects was in 2015, what the number of connected objects will be in 2025. What are the two most used access technologies?

**Q.1B4** Using slide 24, indicate which are the main unlicensed LPWAN standards. Which one has the largest communication range? The smallest?4

**Q.1B5** Using slide 25, indicate which are the main licensed LPWAN standards. Which one has the highest upload rate? The lowest? The highest latency? The lowest?

**Q.1B6** Using slide 26, for each application described in slide 19, indicate which LPWAN technology might be most suitable.

### C. IoT Protocols

**Q.1C1** Using slide 30, indicate what are the main Internet Layer protocols for IoT as well as the main application layer protocols.

Note that Section 2 focus on one of the protocols identified here: MQTT.

**Q.1C2** Using slide 31, explain what is theIETF 6LoWPAN protocol. According to slide 20, which IoT networks can used this protocol?

### D. IoT Applications

**Q.1D1** Using slide 48, indicate what are the main factors that could foster the development of the IoT.

**Q.1D2** What are the main potential applications for IoT? (Slide 49 of proposed presentation)

**Q.1D3** Using slide 55, cite 3 IoT technology providers for 1) sensors and connectivity, 2) gateways, 3) data platform and 4) data visualization and analytics

### E. LoRa Technology

**Q.1E1** What is the difference between LoRa and LoRaWAN? What are the main elements of a LoRaWAN Architecture? Can LoRa be used withou LoRaWAN? (slides 60, 61)

**Q.1E2** What are the differences betweeen LoRaWAN specifications in Europe and North America? (slide 62)

**Q.1E3** What are the main LoRaWAN Device Classes? What is the intended use of these devices? (slides 63, 64)

**Q.1E4** What are the differences between these different classes in terms of reception windows? (slides 65 to 67)

**Q.1E5** What is the principle of Spread-Spectrum transmission? (slides 68, 69)

### F. LoRaWAN Network

**Q.1F1** What are the main components of a LoRaWAN network? (slide 72)

**Q.1F2** Are the MAC layers of the gateway and the node the same? Why? (slide 74)

**Q.1F3** What is the difference between the message format for uplink and downlink messages? (slides 77, 78)

### G. LoRaWAN Security

**Q.1G1** What are the three distinct LoRaWAN AES-128 bit security keys? What is their role? (slide 80)

**Q.1G2** What is the OTAA method? What is the activation scheme for this method? (slides 82, 83)

**Q.1G3** Why is the ABP method less secure? (slide 84)

### H. Sigfox

**Q.1H1** What are the main differences between the LoRaWAN and Sigfox architectures from a technological point of view? (source: https://www.geeksforgeeks.org/difference-between-lorawan-and-sigfox/)

**Q.1H2** What are the main difference between the LoRaWAN and Sigfox solutions from a business plan perspective? (source: https://learn.adafruit.com/alltheiot-transports/lora-sigfox)

**Q.1H3** What are the benefits of each solution? Their limits? Which use case could be used with a Sigfox solution? A LoRaWAN solution? (source: https://learn.adafruit.com/alltheiot-transports/lora-sigfox)


## 2. Application layer Protocols: Discovering MQTT Through Experiments (1h30-2h)


MQTT (Message Queuing Telemetry Transport) is a lightweight messaging protocol based on TCP/IP. It is widely used in the field of IoT for medical and home automation applications as well as for transport, logistics or security and surveillance. Among the main advantages of this protocol we can mention the scaling, the reduction of bandwidth consumption (linked to the Pub/Sub model), its bi-directional capabilities, the simplification of communications or the reduction of development time. 

This protocol must allow the transmission of data for both sensing/crowdsensing and remote control between a server and sensing/crowdsensing and remote control between a server and clients. To do this, MQTT follows a Pub/Sub MQTT follows a Pub/Sub model (Publish/Subscribe) visible below. Five main concepts are are necessary to understand this model: publisher (or producer), broker broker, subscriber (or consumer), topic and data.

The publisher and the subscriber are both clients of the MQTT broker (intermediate server for all server for all clients). Each publisher sends data to the broker on a given topic. . Each subscriber subscribes to some topics and receives (from the broker) by push all data concerning its subscriptions. In our case this MQTT broker will be used to collect information from the sensors.

Various free and open-source versions of MQTT brokers and libraries (C, C++, Java, Javascript, Python, etc.) to program MQTT clients exist. In In the context of IoT and M2M (Machine-to-Machine) networks, we speak in particular of ActiveMQ, JoramMQ and Mosquitto (used in this tutorial). Concerning the libraries for the client, the most advanced is the Eclipse Paho project which offers implementations of different messaging protocols.


<div style="text-align:center">
  <figure>
      <img src="https://eduscol.education.fr/sti/system/files/images/ressources/pedagogiques/13195/13195-paste-1617006027.png" style="float: left; margin-right: 10px;">
      <figcaption>Figure: Example of MQTT Architecture
      </figcaption>
  </figure>
</div> 


### A. Introduction to MQTT 

  * You will first need to install MQTT (on a standard Ubuntu machine/VM). To do this, running the `install.sh` script should be enough.

  * Once this is done, start the MQTT service: `sudo service mosquitto start`

**Q.2A1** Re-explain how MQTT works (could use slide 32). What is the format of a MQTT message? (slide 37)

**Q.2A2** CoAP is another widely used protocol for connected objects (MQTT and CoAP is the two main ones). What is the difference between CoAP and MQTT? (slide 46)

Now that the broker is launched, we will create in a first terminal a client that subscribes to the topic "testMQTT" and in another terminal a second client that publishes the message "Hello world !" in this topic.

  * To do this you will need to use the commands :
```console
host % mosquitto_sub
host % mosquitto_pub
```
Warning: To indicate to which topic to subscribe (mosquitto_sub) and on which topic to publish publish "Hello world!" these functions need arguments (notably "-t") that you can find thanks to the helpers (mosquitto_sub --help).

  * Launch the subscriber in one terminal and, once the message has been published in another terminal, check that it has been received by the subscriber.

  * Now that you have succeeded, open a third terminal and create a second client subscribed to the same topic. When posting a new message, check that both subscribers receive it.

### B. Paho Python MQTT Client

**Q.2B1** What is Paho MQTT?

  * Create in the current folder two files `mqtt_subscriber.py` and `mqtt_publisher.py` that we will use in the rest of this tutorial.

  * The code below is a simple implementation of an MQTT subscriber, copy it in the file `mqtt_subscriber.py` by replacing the "???" by relevant by relevant data. Note that MQTT_SERVER is the address of the MQTT server server and MQTT_PATH is the topic name.

```console
import paho.mqtt.client as mqtt

MQTT_SERVER = "???" # MQTT server address
MQTT_PATH = "???" # Topic name
def on_connect(client, userdata, flags, rc):
  print("Connection code : "+str(rc))
  # Subscribe to the topic
  client.subscribe(MQTT_PATH)

# A publish message is received from the server
def on_message(client, userdata, msg):
  print(“Sujet : ”+msg.topic+" Message : "+str(msg.payload))

client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.connect(MQTT_SERVER, 1883, 60)

client.loop_forever()
```

  * Similarly, copy the code below into the `mqtt_publisher.py` file replacing the "???"

```console
import paho.mqtt.publish as publish
MQTT_SERVER = "???"
MQTT_PATH = "???"
publish.single(MQTT_PATH, "Hello World!", hostname=MQTT_SERVER)
```

  * Run the program `mqtt_subscriber.py` then the program ``mqtt_publisher.py` in another terminal and check that the subscriber has received the message sent.

Note: In case the connection/sending of data is not possible, go to /etc/mosquitto/mosquitto.conf and replace the line allow_anonymous false with allow_anonymous true. Once this change has been made, restart the mqtt server so that it takes effect: sudo service mosquitto restart.

### C. Ping (Keep Alive)

  * Modify the file `mqtt_subscriber.py` to add a new function (at the end of this sub-section 2.3 you can if you wish remove this function, which will avoid seeing the logs displayed on the screen):

```console
def on_log(client, userdata, level, buf):
  print("log: ",buf)

client.on_log=on_log # set client logging
```

To skip the 60 second wait, you can also replace the value 60 with a smaller value in the `client.connect` (e.g. 6). Restart the MQTT client.


**Q.2C1** What do you notice once the X seconds indicated in the client.connect are over? What is the purpose of such a mechanism? What happens if the publisher sends a message to the subscriber? What do you think happens if the MQTT broker does not get a response from the client?

### D. Persistent Sessions and QoS

  * In the file `mqtt_subscriber.py` we will add a new parameter at the time of the creation of the MQTT client: `clean_session = False`

  * Once this parameter is added, launch the MQTT client and then stop it. Launch the publisher
mqtt_publisher.py and restart the client.

  * We will now change the clean_session parameter to `True`. Try to restart the MQTT client.

**Q.2D1** What do you notice? What do you think is the advantage of defining the client ID for the creation of a persistent session?

To test the relevance of the persistent session, we will first try to test it as is.

  * After defining an identifier for the client (client_id="test") when creating the MQTT client, repeat the same operations as in the first part of this sub-section: Launch the client, stop it, launch the publisher, restart the client.

You should see that no changes have occurred.

Indeed, with Paho MQTT the QoS is 0. With this level of QoS the messages are delivered only if the publisher and the subscriber are messages are delivered only if the publisher and the subscriber are currently connected.

To test the value of these persistent sessions, we will modify the QoS value for both the publisher and the subscriber.

  * To do this, we will add the parameter qos=1 when the publisher sends a message and when the message and when the subscriber subscribes to a topic.

  * Once this is done, repeat the previous operations: launch the client and stop it, launch the publisher (several times!) and restart the MQTT client.

**Q.2D2** What do you notice? What is the advantage of this type of persistent sessions? Find out (on the internet) what the difference is between a QoS of 1 and 2. Find out what is stored in a persistent session. Finally, find out in which cases it is interesting to use these QoS levels for both the publisher and the subscriber.

### E. Retained Message

  * In the file `mqtt_publisher.py`, add now a new parameter to the function `publish.single`: `retain=True`

**Q.2E1** Relaunch the publisher client and then launch a new subscriber client (in that order!), what do you see? What could be the interest of such a mechanism?

### F. Last Will and Testament)

  * We will now modify the MQTT publisher to be able to experiment another functionality. To do this, replace the content of the file `mqtt_publisher.py by`:

```console
import paho.mqtt.client as mqtt
MQTT_PATH = "t_channel/test"
MQTT_SERVER = "localhost"
client = mqtt.Client()
client.will_set(MQTT_PATH, "Does it works ?",qos=0)
client.connect(MQTT_SERVER, 1883, 60)
client.loop_start()
client.publish(MQTT_PATH, "Hello World")
client.disconnect()
client.loop_stop()
```

  * Launch the subscriber and then launch the publisher, observe what happens in the subscriber (make sure the *topics* are consistent!).

  * Now repeat the same operation by removing the last line of the file `mqtt_publisher.py` (`client.loop_stop()`).

**Q.2F1** What do you notice? What do you think is the advantage of such a mechanism? In which cases do you notice that this mechanism is activated?

### G. Tree structure and joker


With MQTT there is also the notion of wildcard, which must allow to subscribe to several topics at the same time. This notion is directly linked to the notion of of tree structure. Thus a topic can be separated in different levels separated by slashes (/), for example :

"myRasp / sensors/ temperature"
"myRasp / sensors / pression"

These are two three-level topics, the first level corresponding to "myRasp", the second corresponding to "sensors" and the third corresponding to "temperature" or "pressure". It could be interesting for some customers to subscribe to all the information produced by myRasp or all the sensors from myRasp. In a real case it could be interesting for some customers to get all the information corresponding to my kitchen or more broadly to all the information from the second floor of my house.

This multi-subscription is possible thanks to jokers : "+" and "#". Here we will simply focus on the second "#", named multi-level joker which allows to subscribe to all the topics existing at one level and at lower levels. For example "myRasp/sensors/#" will allow to subscribe to both temperature sensor information and pressure sensor information.

  * Modify the names of the topics in the file mqtt_publisher.py so that they respect the tree structure presented above (so create multiple topics).

  * Create a new MQTT client so that with the help of a wildcard it subscribes to information from the different sensors.

  * Check that the system is working properly.

Considering the tree structure below:

myRasp / groundfloor / livingroom / temperature
myRasp / groundfloor / kitchen / temperature
myRasp / groundfloor / kitchen / pression
myRasp / firstfloor / kitchen / temperature
myRasp / groundfloor / kitchen / fridge / temperature

Using "myRasp/groundfloor/+/temperature" will subscribe to :
myRasp / groundfloor / livingroom / temperature
myRasp / groundfloor / kitchen / temperature

But not to the others, the second or fourth level not corresponding to what is expected.

**Q.2G1** What does this second joker (+) seem to do? Explain how it works and why it is useful.

**Q.2G2** What can wildcards do in concrete cases? Give some examples!

### H. Authentication

Currently, any client, even if not identified, can connect to the broker but also read the content of all the topics without any control. In this part we will configure the MQTT broker so that the authentication of a client with a valid username and password is necessary for a connection to be possible.


  * Start by creating a password storage file with the command
(this command cannot be used without a user's name being entered!) :

```console
host % mosquitto_passwd -c <nom_du_fichier> <nom_du_user>
```

  * View the contents of the file you just created. What does it look like? Add a second user to this file with the command: `mosquitto_passwd <filename> <user_name>`

  * We are now going to use this file. To do this we will have to copy it to the /etc/mosquitto/ folder and modify the /etc/mosquitto/mosquitto.conf file by adding the following lines:

```console
password_file /etc/mosquitto/<nom_du_fichier>
allow_anonymous false
```
Note that the second line allows to prevent the connection of clients who don't have identifiers (anonymous clients). 

  * After restarting the MQTT service (sudo service mosquitto restart), try again again to restart the python subscriber client, what happens?

  * Modify the subscriber and publisher files so that authentication is taken into account:

  * In the file `mqtt_subscriber.py`, add the following line (before "client.on_connect = on_connect") using the data of the user you just created that you have just created: 

`client.username_pw_set(“<username”>,”<password”>)`

  * Do the same in the file `mqtt_publisher.py`.

  * Check that it is possible to publish and subscribe to topics again.

**Q.2H1** Different return codes ("5" for example) were returned by the MQTT broker when the subscriber tried to connect, what could be the different codes returned by the MQTT broker and what do they correspond to?

Now we will try to set up restrictions for write/read access to topics.

To do this you will need to indicate in the mosquitto.conf configuration file where to find the access control management file (`acl_file`) as well as to define the content of this file.

Knowing that the definition of rights in the acl_file is:

```console
user <username>
topic [read|write|readwrite] <topic_name>
```
**Q.2H2** What should the contents of the acl_file look like so that the first user user1 can read the topic myRasp / groundfloor / livingroom / temperature and the second user user2 can write?



## 3. To Go Further: Implementing End-to-End (E2e) LORAWAN Architectures (+/- 10 min)

If you have an end device (or a gateway) that you want to connect to a LoRaWAN network (or even if you don't have any nodes!) open-source and free solutions exist to deploy end-to-end LoRAWAN Architectures (cf. figure below). 

<div style="text-align:center">
  <figure>
      <img src="https://hackster.imgix.net/uploads/attachments/1117892/_la7bfJ4gh4.blob?auto=compress&w=900&h=675&fit=min&fm=jpg" style="float: left; margin-right: 10px;">
      <figcaption>Figure: Example of architecture based on TTN and IoT-LAB (Source: https://www.hackster.io/gianmarcozizzo/aws-based-iot-system-using-riot-os-lorawan-ttn-iot-lab-dae93b)</figcaption>
  </figure>
</div> 

**Q.31** What is TTN? What could be its potential applications? (need to find this information by yourself online)

**Q.32** What is FIT IoT-LAB? How could it be used? (need to find this information by yourself online)

An implementation of such a solution is presented in this tutorial: https://www.iot-lab.info/legacy/tutorials/riot-ttn/index.html 

*Note:* Be careful, the tutorial presented here is not functional. It is based on version 2 of TTN and evolutions would be necessary if you wanted to implement this solution (current version of TTN is V3).
