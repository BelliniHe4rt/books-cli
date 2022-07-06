create table users(
    id int primary key auto_increment,
    name varchar(100) not null,
    birthdate date not null,
    gender varchar(10)
); 

create table books(
    id int primary key auto_increment,
    title varchar(100) not null,
    author varchar(100) not null,
    genre varchar(100) not null,
    publisher varchar(100) not null,
    pages int(4) not null,
    available int(1) not null default(1)
);

create table user_books(
    id int primary key auto_increment,
    user_id int not null, 
    book_id int not null,
    current_page int(4) not null default(1),
    devolution_at timestamp,
    foreign key (user_id) references users(id),
    foreign key (book_id) references books(id)
);

insert into users (name, birthdate, gender) values ('Bellini', '1950-08-07', 'female');
insert into users (name, birthdate, gender) values ('Dani', '1999-03-08', 'male');

select id, name, birthdate from users;

delete from users where id = 4; 
