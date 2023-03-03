show DATABASES;
use assign1mysql;

-- Defining and creating table team.
create table team(
  teamName VARCHAR(255),
  teamCaptain VARCHAR(255),
  PRIMARY KEY (teamName)
);

-- Defining and creating table fixture.
create table fixture(
  matchId int,
  venue VARCHAR(255),
  matchDate DATE,
  team1 VARCHAR(255),
  team2 VARCHAR(255),
  tosswinner VARCHAR(255),
  matchWinner VARCHAR(255),
  PRIMARY KEY (matchId),
  Foreign Key (team1) REFERENCES team(teamName),
  Foreign Key (team2) REFERENCES team(teamName),
  Foreign Key (tossWinner) REFERENCES team(teamName),
  Foreign Key (matchWinner) REFERENCES team(teamName)
);

-- Inserting values into team table.
INSERT INTO team (`teamName`, `teamCaptain`)
VALUES("A", "AC");
INSERT INTO team (`teamName`, `teamCaptain`)
VALUES("B", "BC");
INSERT INTO team (`teamName`, `teamCaptain`)
VALUES("C", "CC");
INSERT INTO team (`teamName`, `teamCaptain`)
VALUES("D", "DC");

-- Insert values into fixture table.
INSERT into fixture (matchId, venue, matchDate, team1, team2, tosswinner, tosswinner)
VALUES(001, "kolkata", "2023-02-03", "A", "B", "A", "A");
INSERT into fixture (matchId, venue, matchDate, team1, team2, tosswinner, tosswinner)
VALUES(002, "Delhi", "2023-02-04", "C", "B", "B", "C");
INSERT into fixture (matchId, venue, matchDate, team1, team2, tosswinner, matchwinner)
VALUES(003, "Delhi", "2023-02-04", "A", "C", "A", "C");
INSERT into fixture (matchId, venue, matchDate, team1, team2, tosswinner, matchwinner)
VALUES(004, "Kolkata", "2023-02-05", "D", "B", "B", "D");

-- Showing fixture from cross product.
select f.venue, f.matchDate, f.team1, f.team2, tm1.teamCaptain as t1captain, 
tm2.teamCaptain as t2captain, f.tosswinner, f.matchWinner
from fixture as f, team as tm1, team as tm2
where f.team1 = tm1.teamName and f.team2 = tm2.teamName
ORDER BY f.team1;

-- Showing fixture using join.
select f.venue, f.matchDate, f.team1, f.team2, tteam.t1C, 
tteam.t2C, f.tosswinner, f.`matchWinner`
from fixture as f
left JOIN
(select tm1.`teamName` as t1N, tm1.`teamCaptain` as t1C,
tm2.`teamName` as t2N, tm2.`teamCaptain` as t2C
from team as tm1, team as tm2) as tteam
on f.team1 = tteam.t1N and f.team2 = tteam.t2N
ORDER BY f.team1;

-- Show values in team.
select tm1.`teamName` as t1N, tm1.`teamCaptain` as t1C,
tm2.`teamName` as t2N, tm2.`teamCaptain` as t2C
from team as tm1, team as tm2
where tm1.`teamName` <> tm2.`teamName`
ORDER BY t1N;

