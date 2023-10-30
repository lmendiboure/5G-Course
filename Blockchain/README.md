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

**QB.3 Which line in Dockerfile.nodes appears to have created this user? In which of the files provided in this topic is this password stored?** You can retrieve this information from docker-compose.yaml

We're now going to discover a new way of connecting and interacting with the RPC node. 

To do this, we're going to connect to the geth client, which is part of the deployed Docker network. As you can see from its docker file (`Dockerfile.user`), it has all the necessary tools: geth and solc in particular.

The connection line is as follows:  `docker exec -it "CONTAINER_NAME" /bin/bash`. Using `docker ps` you should be able to retrieve the name of this container.

Once connected, the idea now is to attach to the RPC node. To do this, simply enter the following line: `geth attach rpc:http://IP:port`.

**QB.4 What IP and port must be specified?**

Once attached, you can now check that everything is working properly by displaying the list of user accounts currently registered in the blockchain once again: `eth.accounts`

At this point, if you wish, you can delete the second RPC node you've added. You won't need it for the rest of this tutorial.

### C. Managing users

### 


