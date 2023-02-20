# Pratical Exercise: Experimenting and Understanding some simple attacks in Wireless Networks

The goal of this hands-on is to understand some of the types of attacks that can occur against UE, the access network or the 5G core network.

## 1. Theoretical analysis of Side-Channel Attacks

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

To answer these questions, you can use the information presented in slides 25 and 26 in https://www.emse.fr/~nadia.el-mrabet/Presentation/Course5_SCA.pdf

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

To answer this question, you can use the information presented on slide 37 in https://www.emse.fr/~nadia.el-mrabet/Presentation/Course5_SCA.pdf

### 1.3 Differential Power Analysis (DPA)

While SPA and fault injection attacks are part of "simple" attacks that can be executed in a poorly protected environment (which corresponds to many IoT objects), DPA attacks are part of more complex attacks that can be executed against better protected systems.

The DPA attack is based on the idea that the power consumption is different according to the states (bit at 0 or 1) and the transitions (1->0 or 0->1).

However, these variations are infinitesimal and can be hidden by the existence of noise or measurement error.

Therefore, the DPA approach also relies on statistical analysis: the attacker will repeat the same operation several times (1000, 10000) to deduce trends.

Thus, thanks to this approach, the attacker will be able (after a certain time...) to associate the measurement of a given moment with a state (or a transition) and consequently to deduce the private key of the IoT device. 

This attack, based on very small variations, and not linked to an error in the implementation of the encryption algorithm, is much more powerful than SPA and fault injection attacks. However, countermeasures are possible.

**Q4.** Quelles contremesures pourraient être proposées contre ce genre d'attaques ?



## 2. Environment Setup

### 2.1 Installation

Two possibilities 

### 2.2 Running Lab for the First Time 

## 4. To go further

Beyond the countermeasures currently implemented, many organizations are working on the definition of new solutions that could help strengthen the security of communication networks. Among the potential solutions, a technology is strongly emphasized: the Blockchain.

**Q.** Using the example of connected objects (one of the three major applications of 5G), try to understand why this technology could help strengthen security in this ecosystem
(potential source: https://www.itransition.com/blog/blockchain-iot-security )

For your personal culture (or your entertainment?) a tool could be useful: Shodan.

**Q.** What is Shodan (https://www.shodan.io/)? How does this tool seem to work? How could it be used? What are the risks?

Other tools that might interest you: Metasploit, Kali Linux 
((if you have any questions about this, don't hesitate to ask me!)
