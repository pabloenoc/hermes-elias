# Hermes

Hermes is an app that lets the user curate their news sources and build their own media consumption algorithm. 

## Installation

Install dependencies with [composer](https://getcomposer.org).

```bash
$ composer update
```

### Create Database

We are using SQLite3 for the database. Here is what the development database setup looks like.

```bash
$ sqlite3 hermes_development.sqlite < db/schema.sql
```

```bash
sqlite> .schema
```

```sql
CREATE TABLE IF NOT EXISTS "feeds" (
	"id"	INTEGER NOT NULL UNIQUE,
	"title"	TEXT NOT NULL,
	"url"	TEXT NOT NULL UNIQUE,
	"format"	TEXT NOT NULL DEFAULT 'atom',
	"last_fetched_at"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
```


## Changelog

### 2026-02-26
- Added linkpost styles
- Styled input bar
- Fix errors display to appear when needed only

### 2026-02-24
- Remove two columns layout
- Display feed links

### 2026-02-19
- Create page error flash messages
- Handle general Exception cases e.g. broken XML strings
- Create XML key in feeds

### 2026-02-10
- Review try... catch... blocks
- Exception handling for feed parsing

### 2026-01-29
- Create database
- Create form to save data to db

### 2026-01-27
- Created the Hermes database
- Created a `feeds` table 
- Downloaded DB Browser for SQLite

### 2026-01-22
- Created navbar
- Style fixes
- Created public/ dir

### 2026-01-15
- Learn about PHP as a templating language

### 2026-01-13

- Initialize composer 
- Load dependencies via composer

### 2026-01-08 

- Happy birthday!
