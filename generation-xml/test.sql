CREATE TABLE account(
   user_id serial PRIMARY KEY,
   created_on TEXT,
   last_login TEXT
);


INSERT INTO account (created_on, last_login)
VALUES
    ("test col11","test col21"),
    ("test col12","test col22")
