#Finding Users relevant to a job description

[Job Description](https://angel.co/hachi/jobs/113813-senior-software-engineer)

**Fields/tags from the job description that we can use to filter user profile**

- Job title- Senior software engineer.

		Related titles- developer, software developer, software engineer, software architect, senior software architect, full stack developer, PHP developer, backend engineer, backend developer, frontend developer.

- Skill PHP(primary)

		other tags from JD- polyglot, unit testing, data science, data mining, machine learning.
		Other related tags - Databases, SQL, noSQL, mongo, 

for any skill tag we can find related tags from here and here

- Location- even though it shouldn't, location does matter. A person is more likely to be interested in a better job in the same city or at least in the same country.

- experience.


**Getting the data**

Potential User profile data sources-
- Linkedin- this would be ideal. It would give access to users skill set, experience, current job profile
Problem- you need to be partner to access their API which costs money.

- Angel List- they have an api which has user profiles with tags for roles, location and skills and would have been another good resource. However in order to use their API you have to register an application. I did but my application hasn't been approved yet.

- facebook, twitter and google plus are quite large and not specific enough for the purposes of this problem statement. 

- Stack Exchange- It has an easily accessible and relatively open API, large number of users with information specific to their skill levels in different domains and is therefore a really good candidate. We have a winner!

		stackexchange data sources-
		- Stack exchange [API](https://api.stackexchange.com/).
		- Stack exchange [data explorer](https://data.stackexchange.com/)

#Steps
- I wrote a Query for downloading user profile data for users located in major indian cities. The data is sorted by users reputation
- Ignore the users which had an empty "About me" section
- Find the users which have a designation tag in their profile description. discard the rest.
- For every user starting from the user with the highest reputation, find the top-tags using the stackexchange API,  stop after first hundred such users are found.
- Out of the top tags for each of top hundred shortlisted candidates, find the tags which are relevant for our job description. 
- Calculate a score for every user based on the score of questions and answers related to the relevant tags.
- Sort the candidates according to the score.
- Output the top ten users.

