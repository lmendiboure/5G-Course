# 5G NR - Architecture and Interfaces

The objective of this session is to understand what the main elements of the 5G architecture are. The idea is also to introduce the different protocols used at the Radio level. These elements will be discussed theoretically and then through a practical application.

## 1. Theoretical analysis

The idea is to understand what the main components are and the main differences between 4G and 5G architectures.

### LTE Architecture
<div style="text-align:center">
  <figure>
      <img src="https://www.3glteinfo.com/wp-content/uploads/2014/06/VoLTE-IMS-Architecture.png" style="float: left; margin-right: 10px;">
      <figcaption>Figure: Basic 4G Architecture (Source: https://www.3glteinfo.com/ims-volte-architecture/)</figcaption>
  </figure>
</div>  

**Q.11** Using the image above, identify the four main components composing a 4G architecture. What is the EPS?

**Q.12** What is E-UTRAN? What is its role? (potential source: https://www.tutorialspoint.com/lte/lte_network_architecture.htm)

<div style="text-align:center">
<figure>
    <img src="https://www.interviewbit.com/blog/wp-content/uploads/2022/06/The-Evolved-Packet-Core-768x406.png" style="float: left; margin-right: 10px;">
    <figcaption>Figure: EPC Functions (Source: https://www.interviewbit.com/blog/lte-architecture/)</figcaption>
</figure>
</div>

**Q.13** Using the above image, indicate what are the main functions of the EPC? What is the role of each of these functions? 
(potential source: https://www.interviewbit.com/blog/lte-architecture/) 

**Q.14** What is the PCEF? The PCRF? Why Quality of Service (QoS) is an important element? 
(potential source: https://yatebts.com/solutions_and_technology/lte-epc/)


### 5G Architecture

<div style="text-align:center">
<figure>
    <img src="https://www.3gpp.org/images/2022/08/17/5g-fig1.png" style="float: left; margin-right: 10px;">
    <figcaption>Figure: Basic 5G Architecture (Source: https://www.3gpp.org/technologies/5g-system-overview)</figcaption>
</figure>
</div>


**Q.16** Considering the image above, what are the main elements of the 5G architecture? What are the differences between the E-UTRAN and the NG-RAN? 

(potential source: https://commsbrief.com/radio-access-network-ran-geran-utran-e-utran-and-ng-ran/)

<div style="text-align:center">
<figure>
    <img src="https://www.digi.com/getattachment/Blog/post/5G-Network-Architecture/EPC-architechure3v2-1280.jpg?lang=en-US" style="float: left; margin-right: 10px;">
    <figcaption>Basic 5G Architecture (Source: https://www.stl.tech/blog/5g-network-architecture/)</figcaption>
</figure>
</div>

**Q.17** What are the main functions of the 5G Core? What are the main differences compared to the EPC? Why did these functions evolved as that? (potential sources: https://www.linkedin.com/pulse/discover-5g-core-network-functions-compared-4g-lte-paul-shepherd/)

**Q.18** What is the 5G Service-Based Architecture (SBA)? What is the advantage of such an approach? 
(potential source: https://www.metaswitch.com/knowledge-center/reference/what-is-the-5g-service-based-architecture-sba)

**Q.19** What could be the benefits of decentralized 5G Core Functions? (potential source: https://www.digi.com/blog/post/5g-network-architecture)

**Q.111** What is the different between a StandAlone (SA) and a Non-StandAlone (NSA) 5G Architecture? What are the differences between each of this solution? What are the solution the most deployed currently (NA or NSA)? 
(potential source: https://www.techtarget.com/searchnetworking/feature/5G-NSA-vs-SA-How-does-each-deployment-mode-differ ; potential source: https://www.counterpointresearch.com/5g-sa-core-deployments/)

**Q.112** What are network interfaces? What are the differences between the LTE Network Interfaces and the 5G Network Interfaces? 
(potential sources: https://www.rfwireless-world.com/Tutorials/5G-NR-network-interfaces.html; https://www.rfwireless-world.com/Tutorials/LTE-EPC-network-interfaces.html)


### LTE Radio Interface Protocols

<div style="text-align:center">
<figure>
    <img src="https://www.tutorialspoint.com/lte/images/lte_radio_protocol_architecture.jpg" style="float: left; margin-right: 10px;">
    <figcaption>Figure: Radio Protocol Stack for LTE (Source: https://www.tutorialspoint.com/lte/lte_radio_protocol_architecture.htm</figcaption>
</figure>
</div>

**Q.113** What are the two main planes of the LTE Radio Protocol Architecture? What is the role of each of these planes? 
(potential source: https://www.tutorialspoint.com/lte/lte_radio_protocol_architecture.htm)

**Q.114** What are the different layers of the LTE Protocol Stack? What is the role of each of these layers (and of each of the elements of these layers)? 
(potential source:https://www.tutorialspoint.com/lte/lte_protocol_stack_layers.htm)

**Q.115** What is the different between the *Idle* and the *Connected* state? 
(potential source: https://www.rfwireless-world.com/Tutorials/LTE-Protocol-Stack.html)

### 5G Radio Interface Protocols

<div style="text-align:center">
<figure>
    <img src="https://1.bp.blogspot.com/-zQ37wlRovmU/XlFBVm5e_jI/AAAAAAAAEsg/VyA6UzkmTEUfE1kk62AVthKfmnBI5BRlACLcBGAsYHQ/s1600/5G%2BProtocol%2BStack%2B-Control%2BPlane.webp" style="float: left; margin-right: 10px;">
    <figcaption>Figure: Radio Protocol Stack for 5GNR (Source: https://www.lteprotocol.com/2020/02/5g-protocol-stack.html</figcaption>
</figure>
</div>

**Q.116** What are the different layers of the 5G NR Protocol Stack? What is their role? What are the differences between this protocol stack and the LTE Protocol Stack? 
(potential source: https://www.lteprotocol.com/2020/02/5g-protocol-stack.html)

<div style="text-align:center">
<figure>
    <img src="https://devopedia.org/images/article/312/6917.1612249870.png" style="float: left; margin-right: 10px;">
    <figcaption>Figure: 5G NR Channels (Source: https://devopedia.org/5g-nr-channels)</figcaption>
</figure>
</div>


**Q.117** What is a channel? Using the above image, explain what are the different types of channels and their role. 
(potential complementary source: https://devopedia.org/5g-nr-channels) 

**Q.118** What are the main differences between the LTE and the 5G channels? 
(potential sources: https://devopedia.org/5g-nr-channels)

## 2. Let's use it: Open5GS and UERANSIM


**Q.21** What is Open5GS? What is UERANSIM? Why these tools need to be used together?


### 2.1 Setting up the environment

As in previous sessions, we'll be using docker-compose here. All the files are in the deployment folder and, in theory, using the command `docker-compose up -d` will launch the environment. Note that you won't have to touch to two docker containers: 1) mongodb container and 2) webui containers. Both of them are only there to provide functionalities.

**Q.211** Which containers are launched? What do you think is the role of each one?

### 2.2 Trying a first communication

Different configuration files are available and will need to be modified to deploy a complete network. Your main aim will be to indicate the IP address of the different elements (5G functions) within these config files. 

*Note : For the open5GS Core, you will have first to run `./tests/app/5gc` to generate the config file.*

Three files will need to be modified:
  1. `open5gs/build/configs/sample.yaml` within the Core
  2. `open5gs-gnb.yaml` within the gnb (config folder)
  3. and `open5gs-ue.yaml` within the ue (config colder)
  
Before trying for the first time the deployment/running of your own 5G network, you will have to verify:
  - The AMF NGAP IP + UPF GTPU within the config file of the Core Network: It must be equal to the IP of the Core container (`ip addr`)
  - The  `linkIp`, `ngapIp` and `gtpIp` within the RAN config file (gnb file): It must be equal to the IP adress of the gnb container (`ip addr`)
  - The `amfConfigs` IP within the RAN config file (gnb file): It must be equal to the IP of the Core container 
  - The `gnbSearchList` IP within the RAN confif file (ue file): It must be equal to the IP of the gnb container
  
Once these differents elements have been verified, you shoud be able to launch the whole 5G Network!

To do so, within the Core Machine, you should launch the different functions using the following command:

```console
$ ./open5gs/build/tests/app/5gc
```

*Note that:* you could alternatively launch each Core function one by one in different terminals. All off them are within the `/open5gs/install/bin` folder.

Then, within the gnb container, you should be able to launch the gNb using the following command:

```console
$ sudo ./UERANSIM/build/nr-gnb -c UERANSIM/config/open5gs-gnb.yaml
```
If everythink works the following line should appear: `NG Setup procedure is successful`

Within the Core container, you should also be able to see that a gNb is now connected.

**Q21.** What is the role of the NG Setup procedure?

Finally, you should be able to launch an UE within the ue container:

```console
$ sudo ./UERANSIM/build/nr-ue -c UERANSIM/config/open5gs-ue.yaml
```
If everythink works the following line should appear: `Connection setup for PDU session[1] is successful, TU Interface [uesimtun0, 10.45.0.2] is up`.

You should also be able so see within the gNb Terminal and the Core Machine that an UE is now connected.

*Note that:* If at this point in time you encouter AUTHENTICATION issues, you should directly go to next section (2.3) and then come back here.

**Q22.** What is a PDU session?

At this point in time, you should be able to verify that your whole architecture is working and enable your UE to communicate with the outside world.

For example, to see the list of existing nodes within the RAN network, you could use the following command (*within the `UERANSIM/build` folder*): `./nr-cli --dump`

**Q23.** What are the IMSI? MCC? MNC? What are they used for?

Once you get the identity of your UE (`imsi-...`) and your gNb, you should be able to connect to the cli of these nodes using the following command, still within the same folder `./nr-cli name-nodes`.

**Q24.** Once you are connected to this CLI (one time for the gNb and one time for the UE), indicate which commands can be executed for each of these nodes (list of commands can be displayed using `commands` within the CLI)


### 2.3 Managing users

So far, we only launched a single UE already configured in the system. We will now try to see how to register new users within our core network.

To verify that it is required, we will first create, within the RAN container, a copy of the ue config file and modify the IMSI/supi (for example replacing the last 1 by a 2: 'imsi-........2').

**Q25.** If you try to launch a ue using this config file, what happens? How can you explain it?

We wil now try to register this user within the Core VM.

To do so, we will use a new app: the WebUI.

Within a browser, access to `127.0.0.1:9999` and connect using the `admin:1423` credentials.

**Q.26** Add this second ue to the list of subscribers of your 5G Core and show that it worked using a screenshot (of this new user connecting to your core network).

### 2.4 Towards a distributed network core

We're now going to set up a distributed network core. The idea, for example, could be to deploy a UPF function in a separate core. This would be necessary, for example, in an edge computing scenario, where data is processed as close as possible to the user, and we don't want to have to send it up the network.

Your objective will therefore be to add a new container. All other functions will be launched in the core container used until now. The UPF function will be launched in this independent container. All these elements will form a core to which the base station and users will be able to connect.

**Q.** Show me how your new architecture works :)

### 2.4 Open questions

**Q.27** Open5GS can support multiple slices (can be seen in the WebUI when you register users), what is Network Slicing? Also indicate which core functions are 1) common to all slices and their role and 2) which functions are specific to each of the slices?

(potential source: https://www.open5gcore.org/open5gcore/network-slice-support)

**Q.28** In 5G Networks, gNb can be divided into two entities: CU and DU. What are each of them? What is the purpose of this separation?

(potential source: https://www.5gworldpro.com/5g-knowledge/what-is-cu-and-du-in-5g.html)


