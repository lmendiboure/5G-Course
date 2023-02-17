# 5G NR - Architecture and Interfaces

The objective of this session is to understand what the main elements of the 5G architecture are. The idea is also to introduce the different protocols used at the Radio level. These elements will be discussed theoretically and then through a practical application.

Some notes:
  - Links for VMs download: https://ftp.science.ru.nl/cs/kkohls/2021_open5gs_vms/ (if not working, a Google Drive alternative could be proposed)
  - Adress to send your report: *leo.mendiboure@univ-eiffel.fr*

## 1. Theoretical analysis

The idea is to understand what the main components are and the main differences between 4G and 5G architectures.

### LTE Architecture

<figure>
    <img src="https://www.3glteinfo.com/wp-content/uploads/2014/06/VoLTE-IMS-Architecture.png" style="float: left; margin-right: 10px;">
    <figcaption>Basic 4G Architecture (Source: https://www.3glteinfo.com/ims-volte-architecture/)</figcaption>
</figure>

**Q.11** Using the image above, identify the four main components that make up a 4G architecture. What is the EPS?

**Q.12** What is E-UTRAN? What is its role? (potential source: https://www.tutorialspoint.com/lte/lte_network_architecture.htm)

<figure>
    <img src="https://www.interviewbit.com/blog/wp-content/uploads/2022/06/The-Evolved-Packet-Core-768x406.png" style="float: left; margin-right: 10px;">
    <figcaption>EPC Functions (Source: https://www.interviewbit.com/blog/lte-architecture/)</figcaption>
</figure>


**Q.13** Using the above image, indicate what are the main functions of the EPC? What is the role of each of these functions? (potiential source: https://www.interviewbit.com/blog/lte-architecture/) 

**Q.14** What is the PCEF? The PCRF? Why Quality of Service (QoS) is an important element? (Potential source: https://yatebts.com/solutions_and_technology/lte-epc/)

**Q.15** What is the role of the EPC? The role of the E-UTRAN? (potiential source: https://www.interviewbit.com/blog/lte-architecture/)


### 5G Architecture


<figure>
    <img src="https://www.3gpp.org/images/2022/08/17/5g-fig1.png" style="float: left; margin-right: 10px;">
    <figcaption>Basic 5G Architecture (Source: https://www.3gpp.org/technologies/5g-system-overview)</figcaption>
</figure>


**Q.16** Considering the image above, what are the main elements of the 5G architecture? What are the differences between the E-UTRAN and the NG-RAN (potential source: https://commsbrief.com/radio-access-network-ran-geran-utran-e-utran-and-ng-ran/)

<figure>
    <img src="https://www.digi.com/getattachment/Blog/post/5G-Network-Architecture/EPC-architechure3v2-1280.jpg?lang=en-US" style="float: left; margin-right: 10px;">
    <figcaption>Basic 5G Architecture (Source: https://www.stl.tech/blog/5g-network-architecture/)</figcaption>
</figure>

**Q.17** What are the main functions of the 5G Core? What are the main differences compared to the EPC? Why did these functions evolved as that? (potential sources: https://www.linkedin.com/pulse/discover-5g-core-network-functions-compared-4g-lte-paul-shepherd/)

**Q.18** What is the 5G Service-Based Architecture (SBA)? What is the advantage of such an approach? (potential source: https://www.metaswitch.com/knowledge-center/reference/what-is-the-5g-service-based-architecture-sba)

**Q.19** What could be the benefits of decentralized 5G Core Functions? (potential source: https://www.digi.com/blog/post/5g-network-architecture)

**Q.111** What is the different between a StandAlone (SA) and a Non-StandAlone (NSA) 5G Architecture? What are the differences between each of this solution?What are the solution the most deployed currently (NA or NSA)? (potential source: https://www.techtarget.com/searchnetworking/feature/5G-NSA-vs-SA-How-does-each-deployment-mode-differ ; potential source: https://www.counterpointresearch.com/5g-sa-core-deployments/)

**Q.112 What are the differences between the LTE Network Interfaces and the 5G Network Interfaces?** (potential sources: https://www.rfwireless-world.com/Tutorials/5G-NR-network-interfaces.html; https://www.rfwireless-world.com/Tutorials/LTE-EPC-network-interfaces.html)


### LTE Radio Interface Protocols


<figure>
    <img src="https://www.tutorialspoint.com/lte/images/lte_radio_protocol_architecture.jpg" style="float: left; margin-right: 10px;">
    <figcaption>Radio Protocol Stack for LTE (Source: https://www.tutorialspoint.com/lte/lte_radio_protocol_architecture.htm</figcaption>
</figure>


**Q.113** What are the two main planes of the LTE Radio Protocol Architecture? What is the role of each of this plane? (potential source: https://www.tutorialspoint.com/lte/lte_radio_protocol_architecture.htm)

**Q.114** What are the different layers of the LTE Protocol Stack? What is the role of each of these layers (and of each of the elements of these layers)? (potential source:https://www.tutorialspoint.com/lte/lte_protocol_stack_layers.htm)

**Q.115** What is the different between the *Idle* and the *Connected* state? (potential source: https://www.rfwireless-world.com/Tutorials/LTE-Protocol-Stack.html)

### 5G Radio Interface Protocols


<figure>
    <img src="https://1.bp.blogspot.com/-zQ37wlRovmU/XlFBVm5e_jI/AAAAAAAAEsg/VyA6UzkmTEUfE1kk62AVthKfmnBI5BRlACLcBGAsYHQ/s1600/5G%2BProtocol%2BStack%2B-Control%2BPlane.webp" style="float: left; margin-right: 10px;">
    <figcaption>Radio Protocol Stack for 5GNR (Source: https://www.lteprotocol.com/2020/02/5g-protocol-stack.html</figcaption>
</figure>


**Q.116** What are the different layers of the 5G NR Protocol Stack? What is their role? What are the differences between this protocol stack and the LTE Protocol Stack? (potential source: https://www.lteprotocol.com/2020/02/5g-protocol-stack.html)

<figure>
    <img src="https://devopedia.org/images/article/312/6917.1612249870.png" style="float: left; margin-right: 10px;">
    <figcaption>5G NR Channels (Source: https://devopedia.org/5g-nr-channels)</figcaption>
</figure>


**Q.117** What is a channel? Using the above image, explain what are the different types of channels and their role (potential complementary source: https://devopedia.org/5g-nr-channels) 

**Q.118** What are the main differences between the LTE and the 5G channels? (potential sources: https://devopedia.org/5g-nr-channels)

## 2. Let's use it: Open5GS and UERANSIM


<figure>
    <img src="https://www.researchgate.net/publication/360714773/figure/fig3/AS:1160646276202496@1653731044010/Experimental-5G-environment-of-a-5G-mobile-network-UERANSIM-Open5GS.png" style="float: left; margin-right: 10px;">
    <figcaption>Experimental setup considered (Source: https://devopedia.org/5g-nr-channels)</figcaption>
</figure>



**Q.21 What is Open5GS? What is UERANSIM? Why these tools need to be used together?**


### 2.1 Setting up virtual machines

Note: These virtual machines have been proposed by Katharina Kohls (https://kkohls.org/index.html)

Password for virtual machines: *5g* ; Set Keyboard to french: *setxkbmap fr*

Two machines are avaibable there: 
  - one for the Core Network (Open5GS)
  - one for the RAN (UERANSIM)

Everytime you launch the open5gs VM, you will have to launch the following script `5gs_tun_setup.sh` on Desktop. This will be required to enable internet connection for 5G users.



### 2.2 Trying a first communication

###

