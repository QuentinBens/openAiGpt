# openAiGpt
A small article generator test. With open ai Chap GPT

## Install


## What to do ?
* Run ```make build``` it will create the docker image
* Run ```make run``` it will run the container and install dependencies
* Get a free api on [Open AI](https://beta.openai.com/account/api-keys). You can create an account for free with a limited use number
* Fill ```.env``` file with your api key
* Run the generation with ```make start TOPIC=pizza ``` Change the topic for what you want
* Enjoy your html article within ``./generated`` folder
