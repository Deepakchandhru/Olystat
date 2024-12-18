
CREATE TABLE IF NOT EXISTS public.application
(
    application_id serial,
    name character varying(25) COLLATE pg_catalog."default",
    email character varying(35) COLLATE pg_catalog."default",
    phone character varying(12) COLLATE pg_catalog."default",
    preference character varying(25) COLLATE pg_catalog."default",
    exp integer,
    state character varying(25) COLLATE pg_catalog."default",
    CONSTRAINT pk_app PRIMARY KEY (application_id),
    CONSTRAINT pk_phone CHECK (length(phone::text) = 10)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.application
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.country
(
    country_id integer NOT NULL,
    country character varying(25) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT pk_con PRIMARY KEY (country_id, country),
    CONSTRAINT u_con UNIQUE (country)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.country
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.feedback
(
    feedback_id serial,
    username character varying(25) COLLATE pg_catalog."default",
    email character varying(25) COLLATE pg_catalog."default",
    feedback text COLLATE pg_catalog."default",
    CONSTRAINT feedback_pkey PRIMARY KEY (feedback_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.feedback
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.india
(
    year character varying(10) COLLATE pg_catalog."default" NOT NULL,
    gold integer,
    silver integer,
    bronze integer,
    total integer,
    pos integer,
    CONSTRAINT pk_ind PRIMARY KEY (year)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.india
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.login
(
    user_id serial,
    uname character varying(25) COLLATE pg_catalog."default",
    pass character varying(20) COLLATE pg_catalog."default",
    role character varying(10) COLLATE pg_catalog."default",
    status character varying(10) COLLATE pg_catalog."default",
    lastseen timestamp without time zone,
    CONSTRAINT pk_log PRIMARY KEY (user_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.login
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.medallist
(
    medal_id serial,
    player character varying(40) COLLATE pg_catalog."default",
    sport character varying(25) COLLATE pg_catalog."default",
    medal character varying(10) COLLATE pg_catalog."default",
    year character varying(4) COLLATE pg_catalog."default",
    gender character varying(2) COLLATE pg_catalog."default",
    CONSTRAINT pk_med PRIMARY KEY (medal_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.medallist
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.ol12
(
    country character varying(25) COLLATE pg_catalog."default",
    gold integer,
    silver integer,
    bronze integer,
    total integer,
    pos integer NOT NULL,
    CONSTRAINT pk_o12 PRIMARY KEY (pos),
    CONSTRAINT fk_o12 FOREIGN KEY (country)
        REFERENCES public.country (country) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.ol12
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.ol16
(
    country character varying(25) COLLATE pg_catalog."default",
    gold integer,
    silver integer,
    bronze integer,
    total integer,
    pos integer NOT NULL,
    CONSTRAINT pk_o16 PRIMARY KEY (pos),
    CONSTRAINT fk_o16 FOREIGN KEY (country)
        REFERENCES public.country (country) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.ol16
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.ol20
(
    country character varying(25) COLLATE pg_catalog."default",
    gold integer,
    silver integer,
    bronze integer,
    total integer,
    pos integer NOT NULL,
    CONSTRAINT pk_o20 PRIMARY KEY (pos),
    CONSTRAINT fk_o20 FOREIGN KEY (country)
        REFERENCES public.country (country) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.ol20
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.overall
(
    country character varying(30) COLLATE pg_catalog."default",
    gold integer,
    silver integer,
    bronze integer,
    total integer,
    pos integer NOT NULL,
    CONSTRAINT pk_ovr PRIMARY KEY (pos),
    CONSTRAINT fk_ovr FOREIGN KEY (country)
        REFERENCES public.country (country) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.overall
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.place
(
    year character varying COLLATE pg_catalog."default" NOT NULL,
    city character varying(20) COLLATE pg_catalog."default",
    country character varying(20) COLLATE pg_catalog."default",
    CONSTRAINT pk_place PRIMARY KEY (year)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.place
    OWNER to postgres;

CREATE OR REPLACE VIEW public.combined_medal
 AS
 SELECT country,
    round(avg(pos)) AS pos,
    sum(gold) AS gold,
    sum(silver) AS silver,
    sum(bronze) AS bronze,
    sum(total) AS total,
    min(pos) AS top,
    max(gold) AS mgold,
    max(silver) AS msilver,
    max(bronze) AS mbronze,
    max(total) AS mtotal
   FROM ( SELECT ol12.country,
            ol12.gold,
            ol12.silver,
            ol12.bronze,
            ol12.total,
            ol12.pos
           FROM ol12
        UNION
         SELECT ol16.country,
            ol16.gold,
            ol16.silver,
            ol16.bronze,
            ol16.total,
            ol16.pos
           FROM ol16
        UNION
         SELECT ol20.country,
            ol20.gold,
            ol20.silver,
            ol20.bronze,
            ol20.total,
            ol20.pos
           FROM ol20) ovr
  GROUP BY country;

ALTER TABLE public.combined_medal
    OWNER TO postgres;


INSERT INTO country (country_id, country)
VALUES
    (1, 'USA'),
    (2, 'China'),
    (3, 'Russia'),
    (4, 'UK'),
    (5, 'Germany'),
    (7, 'Japan'),
    (8, 'France'),
    (9, 'Australia'),
    (10, 'India'),
    (6, 'Italy'),
    (11, 'Hungary'),
    (21, 'New Zealand'),
    (12, 'Korea'),
    (13, 'Netherlands'),
    (14, 'Brazil'),
    (15, 'Canada'),
    (16, 'Ukraine'),
    (17, 'Spain'),
    (18, 'Cuba'),
    (19, 'Iran'),
    (20, 'Kenya');

INSERT INTO india (year, gold, silver, bronze, total, pos)
VALUES
    ('2012', 0, 2, 4, 6, 55),
    ('2016', 0, 1, 1, 2, 67),
    ('2020', 1, 2, 4, 7, 48);

INSERT INTO ol12 (country, gold, silver, bronze, total, pos)
VALUES
    ('USA', 48, 26, 30, 104, 1),
    ('China', 39, 31, 22, 92, 2),
    ('UK', 29, 18, 18, 65, 3),
    ('Russia', 18, 21, 26, 65, 4),
    ('Korea', 13, 9, 8, 30, 5),
    ('Germany', 11, 20, 13, 44, 6),
    ('France', 11, 11, 13, 35, 7),
    ('Australia', 8, 15, 12, 35, 8),
    ('Italy', 8, 9, 11, 28, 9),
    ('Hungary', 8, 4, 6, 18, 10),
    ('Japan', 7, 14, 17, 38, 11),
    ('Iran', 7, 5, 1, 13, 12),
    ('Netherlands', 6, 6, 8, 20, 13),
    ('Ukraine', 5, 4, 10, 19, 15),
    ('New Zealand', 6, 2, 5, 13, 14);

INSERT INTO ol16 (country, gold, silver, bronze, total, pos)
VALUES
    ('USA', 46, 37, 38, 121, 1),
    ('UK', 27, 23, 17, 67, 2),
    ('China', 26, 18, 26, 70, 3),
    ('Russia', 19, 17, 20, 56, 4),
    ('Germany', 17, 10, 15, 42, 5),
    ('Japan', 12, 8, 21, 41, 6),
    ('France', 10, 18, 14, 42, 7),
    ('Korea', 9, 3, 9, 21, 8),
    ('Italy', 8, 12, 8, 28, 9),
    ('Australia', 8, 11, 10, 29, 10),
    ('Netherlands', 8, 7, 4, 19, 11),
    ('Hungary', 8, 3, 4, 15, 12),
    ('Brazil', 7, 6, 6, 19, 13),
    ('Spain', 7, 4, 6, 17, 14),
    ('Kenya', 6, 6, 1, 13, 15);

INSERT INTO ol20 (country, gold, silver, bronze, total, pos)
VALUES
    ('USA', 39, 41, 33, 113, 1),
    ('China', 38, 32, 19, 89, 2),
    ('Japan', 27, 14, 17, 58, 3),
    ('UK', 22, 20, 22, 64, 4),
    ('Russia', 20, 28, 23, 71, 5),
    ('Australia', 17, 7, 22, 46, 6),
    ('Netherlands', 10, 12, 14, 36, 7),
    ('France', 10, 12, 11, 33, 8),
    ('Germany', 10, 11, 16, 37, 9),
    ('Italy', 10, 10, 20, 40, 10),
    ('Canada', 7, 7, 10, 24, 11),
    ('Brazil', 7, 6, 8, 21, 12),
    ('New Zealand', 7, 6, 7, 20, 13),
    ('Cuba', 7, 3, 5, 15, 14),
    ('Hungary', 6, 7, 7, 20, 15);

INSERT INTO overall (country, gold, silver, bronze, total, pos)
VALUES
    ('USA', 1061, 830, 738, 2629, 1),
    ('Russia', 395, 319, 296, 1010, 2),
    ('UK', 284, 318, 314, 916, 3),
    ('China', 263, 199, 174, 636, 4),
    ('France', 223, 251, 277, 751, 5),
    ('Italy', 217, 188, 213, 618, 6),
    ('Germany', 201, 207, 247, 655, 7),
    ('Hungary', 181, 154, 176, 511, 8),
    ('Japan', 169, 150, 178, 497, 9),
    ('Australia', 164, 173, 210, 547, 10);

INSERT INTO place (year, city, country)
VALUES
    ('2020', 'Tokyo', 'Japan'),
    ('2016', 'Rio de Janeiro', 'Brazil'),
    ('2012', 'London', 'England'),
    ('2024', 'Paris', 'France'),
    ('2028', 'Los Angeles', 'USA');

INSERT INTO medallist (medal_id, player, sport, medal, year, gender)
VALUES
    (1, 'Norman Pritchard', '200M Rally', 'Silver', '1900', 'M'),
    (2, 'Norman Pritchard', '200M Hurdles', 'Silver', '1900', 'M'),
    (3, 'Indian Hockey Team', 'Hockey', 'Gold', '1928', 'M'),
    (4, 'Indian Hockey Team', 'Hockey', 'Gold', '1932', 'M'),
    (5, 'Indian Hockey Team', 'Hockey', 'Gold', '1936', 'M'),
    (6, 'Indian Hockey Team', 'Hockey', 'Gold', '1948', 'M'),
    (7, 'Indian Hockey Team', 'Hockey', 'Gold', '1952', 'M'),
    (8, 'KD Jadhav', 'Wrestling', 'Bronze', '1952', 'M'),
    (9, 'Indian Hockey Team', 'Hockey', 'Gold', '1956', 'M'),
    (10, 'Indian Hockey Team', 'Hockey', 'Silver', '1960', 'M'),
    (11, 'Indian Hockey Team', 'Hockey', 'Gold', '1964', 'M'),
    (12, 'Indian Hockey Team', 'Hockey', 'Bronze', '1968', 'M'),
    (13, 'Indian Hockey Team', 'Hockey', 'Bronze', '1972', 'M'),
    (14, 'Indian Hockey Team', 'Hockey', 'Gold', '1980', 'M'),
    (15, 'Leander Peas', 'Tennis', 'Bronze', '1996', 'M'),
    (16, 'Karnam Malleswari', 'Weightlifting', 'Bronze', '2000', 'F'),
    (17, 'Rajyavardhan Singh Rathore', 'Shooting', 'Silver', '2004', 'M'),
    (18, 'Abhinav Bindra', 'Shooting', 'Gold', '2008', 'M'),
    (19, 'Vijender Singh', 'Boxing', 'Bronze', '2008', 'M'),
    (20, 'Sushil Kumar', 'Wrestling', 'Bronze', '2008', 'M'),
    (21, 'Sushil Kumar', 'Wrestling', 'Silver', '2012', 'M'),
    (22, 'Yogeshwar Dutt', 'Wrestling', 'Bronze', '2012', 'M'),
    (23, 'Gagan Narang', 'Shooting', 'Bronze', '2012', 'M'),
    (24, 'Vijay Kumar', 'Shooting', 'Silver', '2012', 'M'),
    (25, 'Saina Nehwal', 'Badminton', 'Bronze', '2012', 'F'),
    (26, 'Mary Kom', 'Boxing', 'Bronze', '2012', 'F'),
    (27, 'PV Sindhu', 'Badminton', 'Silver', '2016', 'F'),
    (28, 'Sakshi Malik', 'Wrestling', 'Bronze', '2016', 'F'),
    (29, 'Mirabai Chanu', 'Weightlifting', 'Silver', '2020', 'F'),
    (30, 'PV Sindhu', 'Badminton', 'Bronze', '2020', 'F'),
    (31, 'Lovlina Borgohain', 'Boxing', 'Bronze', '2020', 'F'),
    (32, 'Ravi Kumar Dahiya', 'Wrestling', 'Silver', '2020', 'M'),
    (33, 'Bajrang Punia', 'Wrestling', 'Bronze', '2020', 'M'),
    (34, 'Indian Hockey Team', 'Hockey', 'Bronze', '2020', 'M'),
    (35, 'Neeraj Chopra', 'Jawllin Throw', 'Gold', '2020', 'M');


-- Trigger function

Create or replace function log()
returns trigger
language plpgsql
as $$

Begin
If new.status='signed out' AND OLD.status IS DISTINCT FROM NEW.status then
   Update login
   Set lastseen=current_timestamp
   where uname=new.uname;
Elsif new.status='signed in' AND OLD.status IS DISTINCT FROM NEW.status then
   Update login
   Set lastseen=NULL
   where uname=new.uname;
End if;
return new;
End $$;

Create or replace trigger lasttime
after update on login
for each row execute procedure log();
