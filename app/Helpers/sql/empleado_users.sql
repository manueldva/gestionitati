/*para eliminar la migracion mal hecha*/

delete from migrations where id = 60;


/*hacer que el campo username acepte nulos en la tabla users*/



/*asociar usuarios creados*/

update users set
empleado_id = 10
where id = 2;

update users set
empleado_id = 12
where id = 4;

update users set
empleado_id = 11
where id = 5;

update users set
empleado_id = 13
where id = 7;

/**/

insert into users (name, password,empleado_id)
values('Quintana Alexis', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 1);

insert into users (name, password,empleado_id)
values('Recalde Sergio', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 2);

insert into users (name, password,empleado_id)
values('Noguera Jorge','$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 3);


insert into users (name, password,empleado_id)
values('Cáneva Daniel', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 4);


insert into users (name, password,empleado_id)
values('Gobio Walter', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 5);

insert into users (name, password,empleado_id)
values('Garrido Gabriela', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 6);

insert into users (name, password,empleado_id)
values('López Claudia', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 7);

insert into users (name, password,empleado_id)
values('Tatané Pino', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 8);

insert into users (name, password,empleado_id)
values('Vergara Daniel', '$2y$10$CPBOxtSNKUGLw2Dqhu0d1ewDhZs17toKtcdiR06fA.E3./HM3WJKi', 9);


