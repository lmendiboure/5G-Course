## Understand and implement Blockchain functionalities
-------------

For this practical exercise, we're going to use Geth (Go Ethereum), the Go implementation of Ethereum (https://geth.ethereum.org/). Other Ethereum implementations exist, but the Go version is still the most widespread and the easiest to learn.

The other important tool here is the solidity compiler (https://solidity.readthedocs.io/en/v0.4.21/), solc. This will enable us to compile the Solidity files used to implement smart contracts with Ethereum.

Docker containers will be used for all these practical applications. This offers several advantages: 1) the possibility of deploying several nodes with different functionalities on the same machine; 2) the possibility of quickly testing different scenarios; and 3) the absence of any need to install tools other than Docker (AND Docker Compose) on the machine used.

It's worth noting that we'll be using a test environment, and therefore a private blockchain in which we can create users, allocate ethers, carry out transactions, develop and test smart contracts free of charge and quickly. There are also a number of Ethereum test networks (Testnet), but these are primarily aimed at testing smart contracts and not at experimenting with elements of the blockchain architecture.

**Note:** At the end of the session, please send me a short report answering the questions asked in this practical exercise (leo.mendiboure@univ-eiffel.fr).

### A. Deploying a Blockchain network

The folder in which this ReadMe is located contains various files that can be used to launch a Blockchain network, including 1) two DockerFiles and 2) a Docker-Compose file.

Use the command `docker-compose up -d` to launch the Blockchain network.

The Blockchain network you've just launched is made up of different types of node: 1) a BootNode, 2) a miner, 3) an RPC node and a user.

**QA.1 Explain the role of the BootNode, Miner and RPC nodes in a Blockchain architecture.**

By analyzing the docker-compose.yaml file, we can see that the minor and RPC nodes attach themselves to the BootNode when they are initiated, which seems logical given the role of this node. By analyzing this file, we can also see 1) that the RPC node exposes a given port and 2) that all nodes are launched on a given subnet.

**QA.2 Which port does the RPC node expose? What is the address range of the subnet?**

**QA.3 An analysis of this file also reveals that a NetworkID is specified. What is it?**

By analyzing the Dockerfile of the nodes (`Dockerfile.nodes`), you can now see that these files use the same `genesis.json` file for their instantiation. 

**QA.4 What is the role of the genesis block in a blockchain architecture?**

### B. Communicating with a Blockchain network

We will now try to establish communication with this Blockchain network. To do this, we'll start by using JSON-RPC API endpoints (https://geth.ethereum.org/docs/interacting-with-geth/rpc).

To do this, your first task will be to upgrade the docker-compose to add a second RPC node, associating its port 8045 with localhost port 8046.

Once this is done, you should be able to test that your implementation works (new docker-compose up) by using the following command from localhost: `curl -X POST -H "Content-Type: application/json" --data '{"jsonrpc":"2.0","method":"net_version","params":[],"id":67}' http://127.0.0.1:8545` 

**QB.1 What does the result of this curl show you?**

**QB.2 What should you change in this line to return the list of eth accounts registered on this Blockchain network? How many accounts are there at the moment?** To answer this question you can use the following site: https://www.okx.com/okbc/docs/dev/api/okbc-api/json-rpc-api#eth-accounts

**QB.3 Which line in Dockerfile.nodes appears to have created this user? In which of the files provided in this practical exercise is this password stored? What is the value of this password?** You can retrieve this information from docker-compose.yaml

We're now going to discover a new way of connecting and interacting with the RPC node. 

To do this, we're going to connect to the geth client, which is part of the deployed Docker network. As you can see from its docker file (`Dockerfile.user`), it has all the necessary tools.

The connection line to attach to the RPC node is as follows:  `docker exec -it "CONTAINER_NAME" geth attach rpc:http://IP:port`. Using `docker ps` you should be able to retrieve the name of this container.

**QB.4 What IP and port must be specified?**

Once attached, you can now check that everything is working properly by displaying the list of user accounts currently registered in the blockchain once again: `eth.accounts`

At this point, if you wish, you can delete the second RPC node you've added. You won't need it for the rest of this tutorial.

### C. Managing users

We're now going to create two additional users. To do this, you'll need to use the following command: personal.newAccount(). 

**QC.1 What information do you need to specify at this stage?**

Check that both accounts now appear in the list of accounts associated with this Blockchain network.

**QC.2 Using the `eth.getBalance(eth.accounts[0])` function, you should be able to check the balance of individual users. What does it equal for user 1 and for user 2 and for user 3? How do you explain it?**

**QC.3 What does the following function do? What do you think it is useful for?** `personal.unlockAccount(ACCOUNT, PASSWORD)`

### D. Carrying out a first transaction 

Now that our network is up and running, and we know how to connect and authenticate, we're going to make our first money transfer between two users. This is the basic function of a Blockchain network.

These transactions will be stored in Blocks, the basic structure of a Blockchain-based system. 

**QD.1 What is the current number of blocks in the blockchain? To find out, use the eth.blockNumber function.**

The fact that this value is non-zero is mainly due to the fact that we're in a test network.

**QD.2 The difficulty defined in the genesis.json file is very low. What does this mean in terms of block generation speed?**

The advantage of this is that the first user to be created is automatically attached as an account to the miner, so he receives money with each new block generation. This will enable us to carry out our first transaction!

To do this, you can use a line like this one: `eth.sendTransaction({from:EMITTER, to:RECEIVER, value:50000000})`

Note that you can specify the address of a given account (EMITTER/RECEIVER) using the following line: `eth.accounts[1]`.

**QD.3 Which line do you need to enter to transmit money from user 1 to user 2? What operation is required before doing so?**

**QD.4 What information about a block can be retrieved using the eth.getBlock(NUMBER) function? What is the minor's address?**

**QD.5 What information about a transaction can be retrieved using the eth.getTransaction(NUMBER) function? What does gas mean in Ethereum?**

### E. Deploying a first Smart Contract

**QE.1 What is a Smart Contract?**

To begin with, we'll simply try to compile and deploy the current code in the tirelire.sol file. To do this, we'll first compile this file by generating two essential files: a bin file, which corresponds to the compiled contract and therefore to the code that will be placed in the blockchain, and an ABI (Application Binary Interface) file, which will enable us to interact with the hexadecimal content of the bin file in a comprehensible format.

Use your web browser to access `https://chriseth.github.io/browser-solidity/#version=soljson-latest.js`, solidity's real-time online compiler. After accessing this page in a browser, paste the contents of the tirelire.sol file in place of the code on the interface. This should have been automatically compiled and you can now retrieve the `ABI` and `bin` code generated under the variable names `Bytecode` and `Interface`.

Note (important!): if you're using the latest version of the compiler, it may not work. We therefore advise you to modify the configuration parameters to use a working version of the compiler such as: `0.4.24+commit.e67f0147`.

```console
// Store the bin file, remembering to add 0x so that it is correctly interpreted
// as hexadecimal content and put quotation marks around it!

tirelireBin = '0x' + "<BIN from compiler!>"

// Simple storage of the ABI in a variable (JSON format)

tirelireAbi = <abi from compiler>

// Tells Geth that this variable is an ABI: transform JSON into ABI

tirelireInterface = eth.contract(tirelireAbi)

//Unlock the user to publish the smart contract

personal.unlockAccount(eth.accounts[0], "PASSWD")

//Publish the smart contract

var tirelireTx = tirelireInterface.new({from: eth.accounts[0],data: tirelireBin,gas: 1000000})

// Retrieve the hash

tirelireTxHash = tirelireTx.transactionHash

// Finally, we retrieve the contract address

publishedTirelireAddr = eth.getTransactionReceipt(tirelireTxHash).contractAddress

```

Now that you've carried out these various commands, the contract should have been mined and it should be possible to use it! To check this, we'll try using the various functions defined in the tirelire.sol file.

We'll start by putting money into our piggy bank with the command tirelireTx.donner({from:eth.accounts[0], value: "50000000000000000"}). To check that this has worked, we can look at the current balance of this piggy bank with the command eth.getBalance( tirelireTx.address). We can now allocate this money back to the user with the command tirelireTx.retirer({from:eth.accounts[0]}).

Note: You can see that when the smart contract was published, an attribute called gas was specified. Gas is a unit of measurement corresponding to the computational resources required to complete a task, in this case the computational resources required to carry out a transaction, instantiate a smart contract or interact with this smart contract. Of course, some transactions are much simpler than others, and consequently the computation required to set them up is much lighter. A miner devoting his time, electricity and computing capacity to executing code to resolve a proof and set up a transaction needs to be compensated, and it's the Gas that determines how much. Gas is therefore the computing capacity required to execute a smart contract or transaction. The more complex the request, the higher the cost, so it's possible to define a Gas limit, i.e. the maximum amount of Gas you're prepared to spend on a transaction/contract. In the event of an error in the code or a bug, calculation capacity could be infinite, and setting a limit protects against this kind of problem. If the limit is reached, the transaction is interrupted and cancelled. Further information on this subject can be found here ( https://masterthecrypto.com/ethereum-what-is-gas-gas-limit-gas-price/)

**QE.2 According to this article, are there any solutions for prioritizing your transactions over those of others?**

We're now going to take our smart contract a step further by adding variables.

To do this, start by copying the file tirelire.sol into a new file tirelire_2.sol, which you'll work on until the end of this tp (in order to keep a valid base of the file).

Now open the file and create a new public uint variable nbAcces, which you'll instantiate at 0 in the constructor. This function will let us know how many times we've put money into our piggy bank, so we'll need to increment it each time we call the give function.

Once we've gone through these three steps (definition, instantiation and incrementation), we'll need to repeat the steps in the previous question with the tirelire_2.sol file before we can set it up on the blockchain.

Once the file has been set up (abi, bin, contract), check that the changes you've just made are working properly. To do this, first check the value of the public uint variable nbAcces, then deposit some money in your piggy bank and display the value of nbAcces again - it should have been incremented.

In this section, you'll see that a smart contract allows the instantiation of variables whose values will be stored in the blockchain. These variables can be displayed or modified by calling smart contract functions and constructors.

We're now going to set a new value, which will correspond to the goal we want to reach, the number of ethers we want to have stored in our piggy bank before being able to withdraw money from it.

To do this, again in the same file, we first define a new value: goal, which we instantiate at 100000000000000000 in the constructor.

Once this has been done, we'll add a new line to the withdraw function, which should mean that if the sum in our savings account is not greater than or equal to our target, we won't be able to withdraw any money. To do this, you can use the assert function, which allows you to check whether an assertion is true (i.e. similar to an if).

**QE.3 Which line should be added? (ie give the line of code)**

After compiling and adding this contract to the blockchain again, check that what we've just set up works:
  - make a first transfer to the piggy bank tirelireTx.donner({from:eth.accounts[0], value: "50000000000000000"}) and display its balance;
  - try to withdraw money from the blockchain, and display its balance, what do you find?
  - make a second transfer of the same value, and try again to withdraw money from the piggy bank, what happens this time?

By defining this variable and this condition, we can see that if the conditions of an agreement (whatever they may be) are not met, the agreement will not be completed. In this case, if there isn't enough money, we won't be able to withdraw it.

This section also shows that once a variable has been defined, if there is no function to modify it, it will be impossible to interact with it, for example, in our case, to dim it. This value is therefore definitively fixed, and this condition will always be true and necessary.

The only way to modify this value would be to create a new smart contract with a different starting value, but this is a false solution, as the money put into our first piggy bank would be lost...

After paying money to one of the other users, for example: eth.sendTransaction({from:eth.accounts[0], to:eth.accounts[1], value:50000000000000000}) (without money, this user won't be able to pay the minor and therefore won't be able to act on the contract!), deposit money on the contract with user 1 (eth. accounts[0]) tirelireTx.donner({from:eth.accounts[0], value: "100000000000000000"}) and try to empty the contents of the smart contract with the address of the user to whom you carried out the first transaction: tirelireTx.retirer({from:eth.accounts[1]}) (authentication may be required). How much money does our piggy bank now contain?

As you should be able to see, a smart contract is open, and anyone with the contract address can access it. So, any user can interact with the public functions of our contract, and as is the case here, it could be easy for a malicious person to steal the contents of our piggy bank...

To do this, we create and instantiate a new address owner element at msg.sender in the constructor, and add an assert to the withdraw function to check that the address corresponds to the address of the smart contract's creator.

**QE.4 What is the line to be added equal to? (ie give the line of code)**

Once the contract has been deployed, deposit some more money in our piggy bank: piggy bankTx.give({from:eth.accounts[0], value: "100000000000000000"}) then try to access it with another user. What do you find?

## F. Towards DApps

**QF.1 What is a DApp?**

The web3.personal.unlockAccount method is not available in the latest versions of Web3.js, and it's not recommended for use in web applications due to security concerns. Unlocking an account in this way is typically performed in the Ethereum client's console for development purposes.

To interact with Ethereum accounts in a more secure and user-friendly manner in a Dapp, you should use a wallet provider like MetaMask. MetaMask handles account management and signing transactions securely. Users can install the MetaMask browser extension and connect it to your Dapp, providing a better user experience.

**QF.2 What is MetaMask?**

In this section, we'll see whether or not it's possible to run a DApp locally on our own network. 

To do this, you'll need to add MetaMask to your browser and configure it to use our local network. You can follow this guide for example: https://dev.to/afozbek/how-to-add-custom-network-to-metamask-l1n 

However, adding the local Blockchain network won't be enough to interact with the local network: you'll also need to add at least one of the network's users. To do this, you'll need to use the user's private key (user 0, for example).

With Geth, the user creation process (cf. previous sections) does not involve storing this private key, as this could pose security problems. Only the passphrase we've recorded in our environment is stored.

You will therefore need to re-generate this private key. To do this, you'll need to connect to one of the three machines on your network (bootnode, miner or RPC) with the following command: ` docker exec -it bc-example_geth-rpc-endpoint_1 sh`.

Once this has been done, you'll need to retrieve the file containing user 0's information, from which you can regenerate his private key. This file is located in: "~/.ethereum/keystore".

Once you've retrieved this file, either directly on your machine by installing web3, or by installing it on the geth docker client, you'll be able to regenerate this key using the following command: `web3 account extract --keyfile FILE-YOU-RETRIEVED --password USER-PASSPHRASE`.

All that's left is to import this account (in your local network) into MetaMask by importing a new user from a private key. At this point, the user's balance should appear. You'll also be able to view future transactions.

This is all that needs to be done at the MetaMask level.

Next, you'll need to modify the dapp file that we provided you by adding YOUR_CONTRACT_ADDRESS, which corresponds to the address of the piggy bank contract (you can get it from geth).

Finally, you'll need to launch a Python (or other) server to share the contents of this html page. To do this, you could simply use the following command (in a folder in which you've put the DApp file): `python3 -m http.server 8000`.

You can then open the browser of your choice and interact with the contract. Please note that you will need to CONNECT MetaMask to this page. To do this, simply click on your MetaMask extension, then on the three dots in the top right-hand corner, and you'll see "Connected Sites", where you can add this site.

All that's left is to test whether or not the whole thing works!









