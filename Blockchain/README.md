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

**QA. Explain the role of the BootNode, Miner and RPC nodes in a Blockchain architecture.**

By analyzing the docker-compose.yaml file, we can see that the minor and RPC nodes attach themselves to the BootNode when they are initiated, which seems logical given the role of this node. By analyzing this file, we can also see 1) that the RPC node exposes a given port and 2) that all nodes are launched on a given subnet.

**QB. Which port does the RPC node expose? What is the address range of the subnet?**

**QC. An analysis of this file also reveals that a NetworkID is specified. What is it?**

### Communicating with a Blockchain network

We will now try to establish communication with this Blockchain network. To do this, we'll start by using JSON-RPC API endpoints (https://geth.ethereum.org/docs/interacting-with-geth/rpc).

