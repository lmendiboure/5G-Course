pragma solidity ^0.4.0;

contract tirelire {

  /* payable est un keyword reserve de solidity qui permet le transfert d ethers*/
  function donner() public payable {

  }

  function retirer() public payable {
    assert(msg.sender.send(address(this).balance));
  }

}


