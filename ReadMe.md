Make sure host has the following dependencies:
1. docker-composer
2. docker
3. php 7.2
4. composer

Steps to run the app:
1. Clone this project
2. Run "composer install --ignore-platform-reqs"
3. Run "docker-compose up -d"

The question and its respective URL for response
Question 1: Return a list of top posts ordered by the number of comments. Consume the API endpoints provided
Answer URL: /api/v1/posts/sort/comments

Question 2: Search API Create an endpoint that allows a user to filter the comments based on all the available fields. Your solution needs to be scalable.
Answer URL: /api/v1/comments?post_id=<id-of-the-post>&comment_id=<id-of-the-comment>&name=<name-of-the-user>&email=<email-of-the-user>&body=<partial-text-of-body>