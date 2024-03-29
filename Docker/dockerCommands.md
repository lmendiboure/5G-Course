### Basic Commands

Different simple command line are enabled using `docker`, you should try some of them:
  - To look for docker images in the Docker Hub, an example for ubuntu keyword: `docker search ubuntu` 
  - To download a pre-build image (debian stretch image here): `docker pull debian:stretch`
  - To see the list of available images: docker images
  - To run an interactive shell within a given container: `docker run -i -t debian:stretch /bin/bash`. In this command line, `-i` indicates that we want to start an interactive container, `-t` creates a pseudo-TTY that attaches stdin and stdout. `exit` should be used to quit a running docker container. **To quit a running interactive container, use the "exit" command**
  - To list all containers: `docker ps -a`; to list running containers `docker ps`
  - To indicate the name of a container (basically launched with an autogenerated name and ID): `docker run --name XXX -i -t  /bin/bash`
  - To directly run commands within a container: docker run -d debian:stretch /bin/sh -c "while true;\ do echo Hi; sleep 1; done"
  - To kill a container `docker kill XXX`
  - To run and stop a container: `$ JOB=$(docker run...) ; $ docker logs $JOB ; docker kill $JOB`
  - To remove a container: `docker stop XXX` + `docker rm XXX`
  - To start/restart a container: `docker (re)start XXX` 
  - To pass variables from your host to your image: `docker run -ti -e FOO=BAR debian:stretch` => Running `echo $FOO` within your container you should be able to see the expected result
  - To commit a new image: `docker commit containerName newImageName` (could be especially useful after installing some new packages within a basic docker image)
  - To locally save an image: `docker save Image Name tarFileName`
  - To load an image from a tarFile: `docker lad -i tarFileName`
  - Indicate the memory that can be used by a container: `docker run -it -m 2GB...`
  - To dee diffications betweeb docker image and docker container: `docker diff dockerName`
  - To see running processes in a container: `docker top dockerName`
  - To map ports: `docker run -d -p machinePort:containerPort --name containerName used Image potentialCOMMAND`
