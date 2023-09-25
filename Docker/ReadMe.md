<center> <h1>Discovering Docker</h1> </center>

**Objective:** Gain comprehensive hands-on experience with Docker containers and Kubernetes through autonomous hands-on tasks.

**Prerequisites:**

- Basic knowledge of Linux commands.
- A computer with internet access and administrative privileges.


## Part 1: Docker Fundamentals 

**Q1. What is Docker? What are the benefits of such an approach?**


### 1. Docker Installation 

- **Step 1:** Install Docker on your local machine.

  Follow the official installation guide for your OS (https://docs.docker.com/engine/install/ubuntu/).

  ```shell
  # Example for Linux (Ubuntu)
  sudo apt-get update
  sudo apt-get install docker-ce

```

To check that Docker is correctly installed on your machine, you could use the following command:

 ```shell
$ docker run hello-world
```

In  this command line:
  1. `docker` tells your operating system you are using the docker program
  2. `run` is one on the different subcommands offered by docker to create an run a docker container
  3. `hello-world` is used to indicated to docker that you are using a specific image that will be loaded in the container


### 2. Docker Pull and Run 

- **Step 1:** Pull a Docker image.

  Pull the "nginx" Docker image.

  ```shell
  docker pull nginx
  ```
  **Q2. What is the role of the pull command?**

- **Step 2:** Run an NGINX container.

  Start an NGINX container in detached mode.

  ```shell
  docker run -d -p 8080:80 nginx
  ```

- **Step 3:** Access the NGINX web server.

  Open a web browser and navigate to `http://localhost:8080`.

 **Q3. Explain me why it is displayed within localhost and what is nginx**

### 3. Building Custom Docker Images (45 minutes)

- **Step 1:** Create a directory for your Docker project.
- **Step 2:** Create a Dockerfile with instructions to build a custom web server using NGINX. (example index.html file within this folder)

  ```Dockerfile
  # Use the official NGINX base image
  FROM nginx

  # Copy your custom HTML files to the NGINX document root
  COPY custom-html-files /usr/share/nginx/html
  ```

- **Step 3:** Build the custom Docker image.

  ```shell
  docker build -t my-web-server .
  ```

- **Step 4:** Run a container from your custom image.

  ```shell
  docker run -d -p 8081:80 my-web-server
  ```

- **Step 5:** Access the custom web server.

  Open a web browser and navigate to `http://localhost:8081`.

 **Q4. Call me to explain me why it works.**

### 4. Docker Networking and Volumes 

- **Step 1:** Create a Docker bridge network.

  ```shell
  docker network create my-network
  ```
**Q5. Explain me what is a bridge network**

- **Step 2:** Run NGINX containers on the custom network.

  ```shell
  docker run -d --network my-network --name nginx-container-1 -p 8082:80 nginx
  docker run -d --network my-network --name nginx-container-2 -p 8083:80 nginx
  ```

- **Step 3:** Observe network communication.

  ```shell
  docker exec -it nginx-container-2 sh
  curl nginx-container-1
  ```

**Q6. Explain me what is the curl command.**

- **Step 4:** Create a Docker volume.

  ```shell
  docker volume create my-volume
  ```

**Q7. Explain me what is a volume.**

- **Step 5:** Attach a volume to a container.

  ```shell
  docker run -d --name nginx-volume-container --mount source=my-volume,target=/data -p 8084:80 nginx
  ```

- **Step 6:** Store data in the volume.

  ```shell
  docker exec -it nginx-volume-container sh
  echo "This is data stored in the volume" > /data/my-file.txt
  exit
  ```

- **Step 7:** Verify data persistence.

  ```shell
  docker run -d --name nginx-volume-reader-container --mount source=my-volume,target=/data -p 8085:80 nginx
  docker exec -it nginx-volume-reader-container sh
  cat /data/my-file.txt
  exit
  ```
**Q8. Explain me why Data Persistence is important**
---

## Part 2: Docker Advanced Topics 

### 5. Docker Compose

- **Step 1:** Install Docker Compose.

  Follow the official installation guide for Docker Compose on your OS (you can try to execute the script located within this folder). 

- **Step 2:** Create a Docker Compose project directory.

  Create a directory named `my-docker-app` for your Docker Compose project.

- **Step 3:** Define a Docker Compose YAML file.

  Create a file named `docker-compose.yml` inside the project directory and define services within it. For example, create services for a web app and a database (e.g., WordPress and MySQL).

  ```yaml
  version: '3'
  services:
    wordpress:
      image: wordpress:latest
      ports:
        - "8080:80"
      environment:
        WORDPRESS_DB_HOST: db
        WORDPRESS_DB_USER: exampleuser
        WORDPRESS_DB_PASSWORD: examplepassword
        WORDPRESS_DB_NAME: exampledb
    db:
      image: mysql:5.7
      environment:
        MYSQL_ROOT_PASSWORD: examplepassword
        MYSQL_USER: exampleuser
        MYSQL_PASSWORD: examplepassword
        MYSQL_DATABASE: exampledb
  ```

- **Step 4:** Start Docker Compose services.

  Run the following command within the project directory to start the defined services in detached mode.

  ```shell
  docker-compose up -d
  ```

- **Step 5:** Access the application.

  Open a web browser and navigate to `http://localhost:8080`.

**Q9. Call me and explain what Docker Compose is and why it is important.**

### 6. Docker Swarm Mode

- **Step 1:** Initialize a Docker Swarm.

  In your terminal, initialize a Docker Swarm on your machine using the following command:

  ```shell
  docker swarm init
  ```
**Q10. Call me to explain me what docker swarm is and why it is important.**

  Note down the command to add worker nodes to the Swarm.

- **Step 2:** Create a Docker Swarm service.

  Create a Docker Swarm service using the following command, specifying an image and desired replicas:

  ```shell
  docker service create --name my-web-app --replicas 3 -p 8081:80 nginx
  ```

  This command creates a service named `my-web-app` with three replicas running NGINX containers.

- **Step 3:** Verify service replicas.

  Check the status of your Docker Swarm service replicas using:

  ```shell
  docker service ls
  ```

- **Step 4:** Scale the service.

  Scale the service to five replicas:

  ```shell
  docker service scale my-web-app=5
  ```

- **Step 5:** Remove the service.

  Remove the Docker Swarm service:

  ```shell
  docker service rm my-web-app
  ```

- **Step 6:** Leave the Swarm (optional).

  If desired, leave the Docker Swarm using the `docker swarm leave` command.

---

## Part 3: Introduction to Kubernetes 

### 7. Minikube Installation 

**Q11. Call me to explain me what are Minikube and Kubernetes. Why these tools are useful?**

- **Step 1:** Install Minikube.

  Follow the official installation guide for Minikube on your OS (https://minikube.sigs.k8s.io/docs/start/).

- **Step 2:** Start a Minikube cluster.

  Start a Minikube cluster using the following command:

  ```shell
  minikube start
  ```

  Wait for the cluster to be up and running.

### 8. Deploying Pods and Deployments Certainly, I can provide instructions for creating a Kubernetes Service and networking for an existing Nginx Deployment. Assuming you have an Nginx Deployment running, here's how you can expose it using a Kubernetes Service:

### 9. Services and Networking for Nginx Example

**Step 1:** Create a Kubernetes Service for Nginx.

- Define a YAML file, e.g., `nginx-service.yaml`, to create a Service for the Nginx Deployment:

```yaml
apiVersion: v1
kind: Service
metadata:
  name: nginx-service
spec:
  selector:
    app: nginx-deployment
  ports:
    - protocol: TCP
      port: 80
      targetPort: 80
  type: LoadBalancer
```

- Apply the Service configuration:

```shell
kubectl apply -f nginx-service.yaml
```

**Step 2:** Verify the Nginx Service.

- Check the status of the Service to get the external IP (for cloud-based setups) or NodePort (for on-premises setups):

```shell
kubectl get svc nginx-service
```

- Access Nginx via the external IP (for cloud-based setups) or NodePort (for on-premises setups) using a web browser or a tool like `curl`.

For cloud-based setups:

```shell
curl http://EXTERNAL_IP
```

For on-premises setups:

```shell
curl http://NODE_IP:NODE_PORT
```

By following these steps, you can expose an existing Nginx Deployment using a Kubernetes Service, making it accessible from outside the cluster.

- **Step 1:** Create a Pod.

  Create a Pod definition YAML file, e.g., `my-pod.yaml`, and apply it to the Minikube cluster:

**Q12. What is a pod?**

  ```yaml
  apiVersion: v1
  kind: Pod
  metadata:
    name: my-pod
  spec:
    containers:
    - name: nginx-container
      image: nginx
  ```

  Apply the Pod configuration:

  ```shell
  kubectl apply -f my-pod.yaml
  ```

Note that you could have to install kubectl (*minikube kubectl -- get po -A*)

- **Step 2:** Verify Pod status.

  Check the status of the Pod:

  ```shell
  kubectl get pods
  ```
**Q13. What is the difference between a pod and a deployment?**

- **Step 3:** Create a Deployment.

  Create a Deployment definition YAML file, e.g., `my-deployment.yaml`, and apply it to the Minikube cluster:

  ```yaml
  apiVersion: apps/v1
  kind: Deployment
  metadata:
    name: my-deployment
  spec:
    replicas: 3
    selector:
      matchLabels:
        app: nginx-app
    template:
      metadata:
        labels:
          app: nginx-app
      spec:
        containers:
        - name: nginx-container
          image: nginx
  ```

  Apply the Deployment configuration:

  ```shell
  kubectl apply -f my-deployment.yaml
  ```

- **Step 4:** Verify Deployment status.

  Check the status of the Deployment:

  ```shell
  kubectl get deployments
  ```


### 9. Services and Networking 

**Q14. What is the aim of services with Kubernetes?**

**Step 1:** Create a Kubernetes Service for Nginx.

- Define a YAML file, e.g., `nginx-service.yaml`, to create a Service for the Nginx Deployment:

```yaml
apiVersion: v1
kind: Service
metadata:
  name: nginx-service
spec:
  selector:
    app: nginx-deployment
  ports:
    - protocol: TCP
      port: 80
      targetPort: 80
  type: LoadBalancer
```

- Apply the Service configuration:

```shell
kubectl apply -f nginx-service.yaml
```

**Step 2:** Verify the Nginx Service.

- Check the status of the Service to get the external IP (for cloud-based setups) or NodePort (for on-premises setups):

```shell
kubectl get svc nginx-service
```

- Access Nginx via the external IP (for cloud-based setups) or NodePort (for on-premises setups) using a web browser or a tool like `curl`.

For cloud-based setups:

```shell
curl http://EXTERNAL_IP
```

For on-premises setups:

```shell
curl http://NODE_IP:NODE_PORT
```

By following these steps, you can expose an existing Nginx Deployment using a Kubernetes Service, making it accessible from outside the cluster.
Certainly, I'll rewrite sections 2.10 and 2.11 based on the Nginx example and integrating ConfigMaps and Secrets:

### 10. ConfigMaps and Secrets 

**Q15. What is the aim of configMaps and Secrets with Kubernetes?**

**Step 1:** Create a ConfigMap for Nginx configuration.

- Define a ConfigMap in a YAML file, e.g., `nginx-configmap.yaml`, to store custom Nginx configuration:

```yaml
apiVersion: v1
kind: ConfigMap
metadata:
  name: nginx-config
data:
  nginx.conf: |
    server {
      listen 80;
      server_name example.com;
      location / {
        proxy_pass http://backend;
      }
    }
```

- Apply the ConfigMap configuration:

```shell
kubectl apply -f nginx-configmap.yaml
```

**Step 2:** Create a Secret for sensitive data.

- Define a Secret in a YAML file, e.g., `nginx-secret.yaml`, to securely store SSL certificate files:

```yaml
apiVersion: v1
kind: Secret
metadata:
  name: nginx-secret
type: Opaque
data:
  ssl-cert.pem: BASE64_ENCODED_CERT
  ssl-key.pem: BASE64_ENCODED_KEY
```

- Apply the Secret configuration:

```shell
kubectl apply -f nginx-secret.yaml
```

**Step 3:** Update the Nginx Deployment to use ConfigMap and Secret.

- Modify the Nginx Deployment to mount the ConfigMap and Secret as volumes:

```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: nginx-deployment
spec:
  template:
    spec:
      containers:
      - name: nginx-container
        image: nginx
        volumeMounts:
        - name: nginx-config
          mountPath: /etc/nginx/conf.d
        - name: nginx-secret
          mountPath: /etc/nginx/ssl
      volumes:
      - name: nginx-config
        configMap:
          name: nginx-config
      - name: nginx-secret
        secret:
          secretName: nginx-secret
```

- Apply the updated Deployment configuration:

```shell
kubectl apply -f nginx-deployment.yaml
```

**Step 4:** Verify ConfigMap and Secret usage in Nginx.

- Access the Nginx pod to check the mounted ConfigMap and Secret:

```shell
kubectl exec -it nginx-deployment-pod -- cat /etc/nginx/conf.d/nginx.conf
kubectl exec -it nginx-deployment-pod -- cat /etc/nginx/ssl/ssl-cert.pem
kubectl exec -it nginx-deployment-pod -- cat /etc/nginx/ssl/ssl-key.pem
```

### 11. Kubernetes Dashboard 

**Step 1:** Install the Kubernetes Dashboard.

- Deploy the Kubernetes Dashboard using the following command:

```shell
kubectl apply -f https://raw.githubusercontent.com/kubernetes/dashboard/v2.0.0/aio/deploy/recommended.yaml
```

**Step 2:** Create a Service Account and Cluster Role Binding.

- Create a YAML file, e.g., `dashboard-admin.yaml`, for the Service Account and Cluster Role Binding:

```yaml
apiVersion: v1
kind: ServiceAccount
metadata:
  name: admin-user
  namespace: kubernetes-dashboard
---
apiVersion: rbac.authorization.k8s.io/v1
kind: ClusterRoleBinding
metadata:
  name: admin-user
roleRef:
  apiGroup: rbac.authorization.k8s.io
  kind: ClusterRole
  name: cluster-admin
subjects:
- kind: ServiceAccount
  name: admin-user
  namespace: kubernetes-dashboard
```

- Apply the Service Account and Cluster Role Binding configuration:

```shell
kubectl apply -f dashboard-admin.yaml
```

**Step 3:** Access the Kubernetes Dashboard.

- Start a proxy to access the Dashboard:

```shell
kubectl proxy
```

- Access the Kubernetes Dashboard at: http://localhost:8001/api/v1/namespaces/kubernetes-dashboard/services/https:kubernetes-dashboard:/proxy/

- Authenticate using the Service Account token.

By following these steps, you can configure ConfigMaps, Secrets, and the Kubernetes Dashboard for an existing Nginx Deployment in Kubernetes.

Certainly, here's the content for sections Part 3.13 (Docker Security), Part 3.14 (Kubernetes Advanced Features), and Part 3.15 (Autoscaling and Load Balancing):

### Part 3: Advanced Docker and Kubernetes Topics 

### 13. Docker Security 

**Step 1:** Secure Docker Daemon.

**Q16. What is the Docker Deamon? What is its role?**

- Restrict Docker daemon access to a specific user group:

```shell
sudo usermod -aG docker your_username
```

- Configure Docker daemon to use a Unix socket for communication (in `/etc/docker/daemon.json`):

```json
{
  "hosts": ["unix:///var/run/docker.sock"]
}
```

**Step 2:** Use Docker Bench Security.

**Q17. What is Docker Bench Security?**

- Run Docker Bench Security to check Docker security configurations:

```shell
docker run -it --net host --pid host --cap-add audit_control \
    -e DOCKER_CONTENT_TRUST=$DOCKER_CONTENT_TRUST \
    -v /var/lib:/var/lib \
    -v /var/run/docker.sock:/var/run/docker.sock \
    -v /usr/lib/systemd:/usr/lib/systemd \
    -v /etc:/etc --label docker_bench_security \
    docker/docker-bench-security
```

**Step 3:** Container Isolation.

- Use Docker Compose to define isolation policies:

```yaml
services:
  myapp:
    image: myapp
    isolation: hyperv
```

**Q18. What is the role of the container isolation?**

**Step 4:** Apply Least Privilege Principle.

- Create custom Docker images with minimal permissions.

**Step 5:** Use Docker Content Trust (DCT).

- Enable DCT for image signing and verification:

```shell
export DOCKER_CONTENT_TRUST=1
```

**Step 6:** Implement Network Segmentation.

- Use Docker's built-in network features for isolation:

```shell
docker network create --driver bridge mynetwork
```

**Step 7:** Regularly Update and Patch.

- Keep your Docker host and containers updated with security patches.

---

### 14. Kubernetes Advanced Features 

**Step 1:** Deploy StatefulSets.

**Q18. What are statefulsets?**

- Define a StatefulSet YAML for stateful applications:

```yaml
apiVersion: apps/v1
kind: StatefulSet
metadata:
  name: web
spec:
  serviceName: "nginx"
  replicas: 3
  selector:
    matchLabels:
      app: nginx
  template:
    metadata:
      labels:
        app: nginx
    spec:
      containers:
      - name: nginx
        image: nginx:1.16
```

- Apply the StatefulSet:

```shell
kubectl apply -f statefulset.yaml
```

**Step 2:** Implement Rolling Updates.

- Use Rolling Updates for safer application updates:

```shell
kubectl set image deployment/nginx-deployment nginx=nginx:1.17 --record
```

**Step 3:** Utilize Helm Charts.

- Package and deploy applications using Helm:

```shell
helm install my-release stable/nginx-ingress
```

**Step 4:** Implement Network Policies.

- Define network policies to control pod-to-pod communication:

```yaml
apiVersion: networking.k8s.io/v1
kind: NetworkPolicy
metadata:
  name: allow-nginx
spec:
  podSelector:
    matchLabels:
      app: nginx
  policyTypes:
  - Ingress
  ingress:
  - from:
    - podSelector:
        matchLabels:
          app: frontend
```

- Apply the NetworkPolicy:

```shell
kubectl apply -f network-policy.yaml
```

**Step 5:** Configure Persistent Storage.

- Use Persistent Volumes (PVs) and Persistent Volume Claims (PVCs) for data persistence.

---

### 15. Autoscaling and Load Balancing 

**Step 1:** Horizontal Pod Autoscaler (HPA).

**Q19. What is the aim of the autoscaling?**

- Define an HPA resource for automatic pod scaling:

```yaml
apiVersion: autoscaling/v1
kind: HorizontalPodAutoscaler
metadata:
  name: myapp-hpa
spec:
  scaleTargetRef:
    apiVersion: apps/v1
    kind: Deployment
    name: myapp-deployment
  minReplicas: 1
  maxReplicas: 10
  targetCPUUtilizationPercentage: 80
```

- Apply the HPA configuration:

```shell
kubectl apply -f hpa.yaml
```

**Step 2:** Cluster Autoscaler.

- Configure the Cluster Autoscaler for dynamic node scaling:

```shell
gcloud container clusters create my-cluster \
  --enable-autoscaling --min-nodes=1 --max-nodes=10
```

**Step 3:** Load Balancers.

- Use Kubernetes Services with LoadBalancer type for external traffic load balancing:

```yaml
apiVersion: v1
kind: Service
metadata:
  name: myapp-service
spec:
  selector:
    app: myapp
  ports:
  - protocol: TCP
    port: 80
    targetPort: 8080
  type: LoadBalancer
```

- Apply the Service configuration:

```shell
kubectl apply -f service.yaml
```

Certainly, here's the global conclusion for the lab:

---

### Conclusion

Congratulations! You've completed the Docker and Kubernetes Advanced Topics Lab. In this hands-on session, you've delved into the intricacies of containerization and orchestration, exploring advanced concepts and practices to enhance your skills in managing and deploying containerized applications.

