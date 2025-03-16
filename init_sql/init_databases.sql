CREATE DATABASE IF NOT EXISTS laravelchallenge;
CREATE DATABASE IF NOT EXISTS laravelchallenge_testing;

grant all privileges on laravelchallenge.* to 'user'@'%';
grant all privileges on laravelchallenge_testing.* to 'user'@'%';

flush privileges;
