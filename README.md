# supercat

Optimy DevOps Engineer Assessment.

The app runs in a free-tier AWS account, at http://supercatalb-1209827839.eu-central-1.elb.amazonaws.com/.

## run Docker container locally

```
docker build -t supercat .
DB_URL=<value> DB_USER=<value> DB_PW=<value>docker run -p 80:80 -d supercat
```

Open http://172.17.0.2/ in a browser.

## authenticate to ECR

```
aws configure sso # first time only
aws sso login
aws ecr get-login-password --region eu-central-1 | docker login --username AWS --password-stdin 202853072354.dkr.ecr.eu-central-1.amazonaws.com
```

## push Docker image to ECR

```
docker tag supercat:latest 202853072354.dkr.ecr.eu-central-1.amazonaws.com/supercat:latest
docker push 202853072354.dkr.ecr.eu-central-1.amazonaws.com/supercat:latest
```

## DB connection

The MySQL database created with the CloudFormation template is not publicly accessible.

From the local machine connect to it using ssh port forwarding. Make sure the security group of the EC2 instance allows access from your public IP.

```
ssh -i supercat-keypair.pem -L 3306:sqlsupercatdemodbinstance-eu-central-1.c7e446c0ouib.eu-central-1.rds.amazonaws.com:3306 ec2-user@18.185.104.237
```

Now the localhost:3306 connection can be used from MySQL Workbench and also to test locally the PHP connection to the RDS DB instance.

## configuration and secrets values

DB connection parameters are placed in the AWS SSM Parameter Store and injected as environment variables in the ECS task definition.

## deployment of Docker container

An ECS service is used to deploy the Docker container.
