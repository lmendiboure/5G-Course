## Understand and implement Blockchain functionalities
-------------

For this practical exercise, we're going to use Geth (Go Ethereum), the Go implementation of Ethereum (https://geth.ethereum.org/). Other Ethereum implementations exist, but the Go version is still the most widespread and the easiest to learn.

The other important tool here is the solidity compiler (https://solidity.readthedocs.io/en/v0.4.21/), solc. This will enable us to compile the Solidity files used to implement smart contracts with Ethereum.

Docker containers will be used for all these practical applications. This offers several advantages: 1) the possibility of deploying several nodes with different functionalities on the same machine; 2) the possibility of quickly testing different scenarios; and 3) the absence of any need to install tools other than Docker (AND Docker Compose) on the machine used.

It's worth noting that we'll be using a test environment, and therefore a private blockchain in which we can create users, allocate ethers, carry out transactions, develop and test smart contracts free of charge and quickly. There are also a number of Ethereum test networks (Testnet), but these are primarily aimed at testing smart contracts and not at experimenting with elements of the blockchain architecture.

**Note:** At the end of the session, please send me a short report answering the questions asked in this practical exercise (leo.mendiboure@univ-eiffel.fr).

### A. few theoretical questions
______

**QA.1** What is the Blockchain? What is a transaction?

**QA.2** Give three examples of potential Blockchain applications.

**QA.3** What is Proof of Work? Briefly explain how it works.

### B. Step 0: Launching a Blockchain node

