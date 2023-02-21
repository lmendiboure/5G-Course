# Pratical Exercise: Experimenting and Understanding some simple attacks in Wireless Networks

The goal of this hands-on is to understand some of the types of attacks that can occur against UE, the access network or the 5G core network.


## 1. Theoretical analysis of Side-Channel Attacks

In this part, through a theoretical study, we will focus on the attacks that can be carried out at the level of the UE itself (hardware). More specifically, we will focus on attacks through side channels.

**Q.1** What is a side channel attack? What are we usually trying to guess? Which values can be measured?
(potential source: https://www.techtarget.com/searchsecurity/definition/side-channel-attack)

### 1.1 Simple Power Analysis (SPA)

A first possible side channel attack, among the simplest, is the so-called Simple Power Analysis (SPA) attack.

This attack consists in directly measuring the consumption of an electrical circuit. The objective of this attack (as well as the other attacks presented in this section) is to guess the private key used by an UE device.

To understand how this attack works, we will focus here on the RSA (Rivest-Shamir-Adleman) public key algorithm, commonly used in the IoT environment.

With this algorithm, the function used to decrypt a message is the following:

**M=C<sup>d</sup> mod(N)**

where *M* is the decrypted message, *C* is the encrypted message, *d* is the private key of the IoT object, and *N* is the multiplication of two prime integers.

Thus, the objective of an attacker here would be to determine the value of *d*.

With RSA, the most efficient method to calculate the exponentiation of an integer by another is the fast exponentiation method:

_____
**Objective, compute d:**

1) Compute the binary decomposition of d

d=d<sub>n</sub>d<sub>n-1</sub>...d<sub>1</sub>d<sub>0</sub><sup>2</sup>

2) Define the value of the result T

T <- C
    
3) Calculate the exponentiation
  
For i from n-1 to 0:
  if d<sub>i</sub>=0:
  
   T <- T x T (square)
      
  si d<sub>i</sub>=1:
        
   T <- T x T (square)
        
   T <- T x C (multipication)

4) return T
____

**Q.2** If you were an attacker, considering the above algorithm, how would you be able to guess the key to the IoT device? To avoid this problem and offer a "constant consumption" solution, whether the bit processed is a 0 or a 1, what countermeasure could you propose?

(Pontential source: https://docs.google.com/presentation/d/1oDPkvdy-NmP3_QjOjONSJRikCFUHAeI5vn8LLvKnRG0/edit?usp=sharing)

### 1.2 Fault Injection Attacks (FIA)

A countermeasure you could have introduced in the previous part could be to introduce a dummy operation when the bit is 0 :

_____
  if d<sub>i</sub>=0:
  
   T <- T x T (square)
   
   U <- T x C (multiplication)
      
  si d<sub>i</sub>=1:
        
   T <- T x T (square)
        
   T <- T x C (multipication)
_____

Thus, thanks to this approach, the solution guarantees a constant energy consumption (whether the bit is 1 or 0) without impacting the final result, making the SPA attack impossible.

However, this solution is imperfect. Indeed, it could be sensitive to so-called fault injection attacks.

These attacks consist in disrupting the operation of the system during the execution of the encryption algorithm: overvoltage, overheating, etc. 

Thus, if the attacker introduces faults at the time of the exponentiation calculation, he will be able to determine whether operations are fake or not:

  - if the attacker disrupts the operation of the system at the time of a fake operation (multiplication in the case where the bit is 0), the final result will not be disrupted by this attack. Thus, the message will be correctly decrypted ;

  - if the attacker disturbs the system at the time of a non-fake operation (multiplication in the case where the bit is 1), the final result will be directly impacted by this attack. Thus, the message will be decrypted incorrectly.

Therefore, this fault injection attack, allows to attack a system protected only against SPA attacks and determine the private key value of the IoT device.

**Q3.** What countermeasure could be proposed to solve this problem?

(Potential source: https://docs.google.com/presentation/d/1oDPkvdy-NmP3_QjOjONSJRikCFUHAeI5vn8LLvKnRG0/edit?usp=sharing)

### 1.3 Differential Power Analysis (DPA)

While SPA and fault injection attacks are part of "simple" attacks that can be executed in a poorly protected environment (which corresponds to many IoT objects), DPA attacks are part of more complex attacks that can be executed against better protected systems.

The DPA attack is based on the idea that the power consumption is different according to the states (bit at 0 or 1) and the transitions (1->0 or 0->1).

However, these variations are infinitesimal and can be hidden by the existence of noise or measurement error.

Therefore, the DPA approach also relies on statistical analysis: the attacker will repeat the same operation several times (1000, 10000) to deduce trends.

Thus, thanks to this approach, the attacker will be able (after a certain time...) to associate the measurement of a given moment with a state (or a transition) and consequently to deduce the private key of the IoT device. 

This attack, based on very small variations, and not linked to an error in the implementation of the encryption algorithm, is much more powerful than SPA and fault injection attacks. However, countermeasures are possible.

**Q4.** What countermeasures could be proposed against such attacks?

## 2. Environment Setup
    
### 2.1 Required Steps

You have two options for the day's practice:
    1. Download a Virtual Machine containing the différent tools that will be required for this practise
    2. Download the different tools required for this practise (for example within the Ubuntu VMs used during the last session!)
    
If you choose the first option, download this VM: https://drive.google.com/file/d/1b0oJ5-UMHXhtMqb2tG4vxp8t0dC2ZUqN/view?usp=sharing
    
If you choose the second option:
    - Download the different folders required to install Netkit (Network Environment Similar to Mininet) at this address (do not take into account the fact that this project is not maintained anymore): https://www.netkit.org/
    - Install Netkit following the different steps described there: https://www.brianlinkletter.com/2013/01/installing-netkit/ (+ check config, very important!)
    
Whatever the option you chose, you could also have to:
    - `git clone https://github.com/lmendiboure/5G-Course.git` OR direction dowload *lab.tar.gz* within the Security folder
    - Extract *lab.tar.gz* (`tar -xvzf`)
    
From this point in time, by simply launching the *lstart* command, at the root of the lab folder, it should be possible for you to launch the experimentation environment.

To stop it, you just have to launch in the same terminal the command *lcrash* (*lclean* to clean the config).
The environment to be emulated here consists of a total of three hosts and two subnets (*lana*, *lanb*):
  - alice (10.0.0.1; 10.0.0.0/8) is a vulnerable host ;
  - bob (192.168.0.1; 192.168.0.0/24) is a second vulnerable host;
  - oscar is a malicious user (10.0.0.2; 10.0.0.0/8).
 
Note that the gateway address of the *lana* subnet is 10.255.255.254.
 
### 2.2 Potentially necessary step

Another tool that will be very important in the rest of these experiments is Scapy. You can use it and run it using the following commands (inside the netkit hosts, this tool may already be installed!):

```console
git clone https://github.com/secdev/scapy.git
cd scapy
./run_scapy
```

**Q5.** What is Scapy?
(potential source: https://scapy.net/)

*Note: In order to use it for these experiments, it will have to be placed in the /lab/shared folder. This way, it will be accessible to NetKit hosts. Like any file/folder you place in this shared folder.

## 3. An example of a Man-in-the-Middle (MitM) attack: ARP Table Poisoning

This is a first potential network attack. Network attacks are a first main category of attacks that can be carried out against the UE and the access network.

**Q6.** What is a MitM Attack? What are the main steps of this kind of attacks?
(potential source: https://www.imperva.com/learn/application-security/man-in-the-middle-attack-mitm/)

**Q7.** Recall the purpose of an ARP table and what ARP Query and Reply are. Also indicate what could be the interest to attack these ARP tables (*ARP Spoofing/ARP Poisoning*).

(potential source: https://en.wikipedia.org/wiki/ARP_spoofing)

Oscar's goal here, using Scapy, is to poison alice's ARP table and pretend to be its gateway 10.255.255.254. Thus, it will receive the traffic destined to the gateway.

To do this, oscar will need to send a forged ARP packet to alice every second indicating that its MAC address matches the MAC address of the gateway.

To achieve this, you will need to use Scapy which allows sending and manipulating packets.

For example, using Scapy in oscar's terminal, and running the following command in Scapy `sr1(IP(dst="10.0.0.1")/ICMP()/"hello")` would ping Alice and display the response.

To create the line allowing this redirection, you can use different commands of Scapy, notably (*getmacbyip, Ether, ARP*).

You can also use the solution proposed by https://medium.com/datadriveninvestor/arp-cache-poisoning-using-scapy-d6711ecbe112 

*Note:* Beware, unlike the solution used above, the easiest way to do this is to use a `who-has` operation, with oscar pretending to be the gateway.

*Note:* The most efficient solution could be for oscar to send a who-has request to alice indicating as sender IP address the IP address of Alice's gateway and not its own (i.e. Alice associates oscar's MAC address with the gateway IP)

Create a command line (or multiple command lines) to poison the ARP table of alice.

With a simple `ping` from alice to bob, you can verify that the poisoning of the ARP table has worked. 

**Q.8** What differences do you observe (with/without poisoning)? What does this redirection correspond to? What countermeasures can be considered to fight against this kind of attacks? 

(potential source: https://en.wikipedia.org/wiki/ARP_spoofing#Defenses)

Man-in-the-Middle attacks are among the main attacks that can be carried out. ARP table poisoning and TCP session hijacking are some examples of these attacks. As this article (https://gizmodo.com/why-apples-huge-security-flaw-is-so-scary-1529041062) shows, many large companies, such as Apple, can be vulnerable to these types of attacks.

**Q.9** What are the main types of MITM attacks and the main techniques used? In general, what countermeasures can be considered against this type of attack?

(potential source: https://www.rapid7.com/fundamentals/man-in-the-middle-attacks/)

## 4. Another example of attack: Denial-of-Service

**Q.10** What is a Denial of Service attack? What is its objective? What is the difference with a Distributed Denial of Service Attack?

(potential source: https://www.ncsc.gov.uk/collection/denial-service-dos-guidance-collection#:~:text=%22Denial%20of%20service%22%20or%20%22,frequently%20reported%20by%20the%20media)

### 4.1 Smurf

*Smurf* attacks are a first possible type of DoS attack.

**Q.11** What is the principle of these attacks?

(potential source: https://en.wikipedia.org/wiki/Smurf_attack)

Create a Scapy command line in oscar to force alice to send ICMP requests to the broacast address 10.255.255.255 in a loop. As mentioned earlier, `sr1(IP(dst="10.0.0.1")/ICMP()/"hello")` could allow an ICMP request to be sent. 

**Q.12** What are the risks of this type of attack? State the countermeasures that can be proposed against this type of attack.

### 4.2 SYN Flood

The *SYN Flood* attacks are a second possible type of DoS attacks.

**Q.13** What is the principle of these attacks?
(potential source: https://www.cloudflare.com/learning/ddos/syn-flood-ddos-attack/)

We will now try to carry out this kind of attack against alice.

To do this, oscar simply creates a multi-layered package for alice:

```console
topt=[('Timestamp', (10,0))]
p=IP(dst="...", id=1111,ttl=99)/TCP(sport=RandShort(),dport=[22,80],seq=12345,ack=1000,window=1000,flags=”S”,options=topt)/”SYNFlood”
ans,unans=srloop(p,inter=0.2,retry=2,timeout=6)
```

**Q.14** What do you think the random elements of this message (id, ttl) are for?

So, with these few lines, oscar will send to alice a packet every 0.2 seconds for 6 seconds. This is a simple example of a *SYN Flood* attack. This rapid succession of SYN requests could lead to an overload of Alice's system and could therefore make it impossible to access alice's services (for example a telnet service).

### 4.3 Ping of the Death

Ping of Death* attacks are a third possible type of DoS attack.

**Q.15** What is the principle behind these attacks?

(potential source: https://en.wikipedia.org/wiki/Ping_of_death)

If oscar wants to carry out this type of attack against alice, with Scapy, he will just have to use a command like `send(fragment(IP(dst=dip)/ICMP()/('X'*60000))`.

The ICMP packet, being fragmented, can be sent, although its size is greater than the maximum size defined for this type of packet. However, reassembling this packet could disrupt the proper functioning of alice.

**Q.16** What are the risks of this type of attack? Indicate the countermeasures that can be proposed against this type of attack.

To answer this question, you can use the information presented in https://www.imperva.com/learn/ddos/ping-of-death/

### 4.4 Overlapping Fragments

**Q.17** What is the principle of these attacks? 

(potential source: https://cyberhoot.com/cybrary/fragment-overlap-attack/)

If oscar wanted to carry out this kind of attack against alice, he would have to create three fragments with Scapy, each using alice's IP address. 

```console
frag1=IP(dst=dstIP, id=12345, proto=1, frag=0, flags=1)/ICMP(type=8, code=0, chksum=0xdce8)
frag2=IP(dst=dstIP, id=12345, proto=1, frag=2, flags=1)/"ABABABAB"
frag3=IP(dst=dstIP, id=12345, proto=1, frag=1, flags=0)/"AAAAAAAABABABABACCCCCC"
```

To be able to analyze the messages received by alice, for this time, we can launch Scapy within alice machine and sniff the messages it receives thanks to the command: `a = sniff(filter='icmp')`

Once this is done, Oscar can send the three fragments sequentially to alice: `sent(frag1)...`

We can then stop the sniffer at alice and analyze the received data with the following commands:

```console
a.nsummary()
a[0]
a[1]
a[2]
a[3]
```
This should allow you to see a complete summary of the ICMP packets received by alice as well as a summary of each of these packets. The 4th packet shows alice's response and should indicate that the second fragment contains an incorrect offset (*offset*).

**Q.25** State the countermeasures that can be proposed against this type of attack.

## 5. To go further

Beyond the countermeasures currently implemented, many organizations are working on the definition of new solutions that could help strengthen the security of communication networks. Among the potential solutions, a technology is strongly emphasized: the Blockchain.

**Q.** Using the example of connected objects (one of the three major applications of 5G), try to understand why this technology could help strengthen security in this ecosystem
(potential source: https://www.itransition.com/blog/blockchain-iot-security)

For your personal culture (or your entertainment?) a tool could be useful: Shodan.

**Q.** What is Shodan (https://www.shodan.io/)? How does this tool seem to work? How could it be used? What are the risks?

Other tools that might interest you: Metasploit, Kali Linux 
(if you have any questions about this, don't hesitate to ask me!)
