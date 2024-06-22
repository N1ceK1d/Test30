INSERT INTO Blocks (id, name)
VALUES
(1, 'ИПП/Тесты'),
(2, 'ПА/курс'),
(3, 'ЗП'),
(4, 'Тесты'),
(5, 'Найм + курс + все мелкие услуги');

INSERT INTO Questions (id, question_text)
VALUES 
(1, 'Есть ли в компании сотрудники, которые часто ошибаются или не делают то, что нужно?'),
(2, 'Есть ли сотрудники, с кем давно пора расстаться, но вы почему-то этого не делаете?'),
(3, 'Есть ли в компании текучка кадров (5 и более увольнений в год)?'),
(4, 'Берут ли сотрудники ответственность за свой результат?'),
(5, 'Проявляют ли сотрудники инициативу в работе?'),
(6, 'Мотивированы ли сотрудники на результат свой личный и компании в целом? (где мотивация - это побуждение к действию)'),
(7, 'Знают ли каждый сотрудник свой продукт (конечный результат труда на своей должности)?'),
(8, 'Измеряются ли результаты труда каждого сотрудника в вашей компании?'),
(9, 'Зависит ли зарплата от результатов труда у каждого сотрудника?'),
(10, 'Может ли каждый сотрудник влиять на свою зарплату увеличивая результат?'),
(11, 'Знает ли точно каждый сотрудник какой именно результат от него ожидается?'),
(12, 'Ставятся ли сотрудникам планы личные и командные?'),
(13, 'Существует ли системные поощрения (бонусы) за выполнение планов или высоких результатов?'),
(14, 'Существует ли системная отчётность у каждого сотрудника?'),
(15, 'Приняты ли в компании какие-то неденежные формы мотивации персонала?'),
(16, 'Есть ли соревновательный процесс или игры по результатам труда сотрудников?'),
(17, 'Знает ли каждый сотрудник как и что он должен делать, чтобы получать результат, который от него ожидается?'),
(18, 'Существует ли в компании для каждой должности Инструкции по продукту* (прописаны бизнес процессы или что-то подобное)'),
(19, 'Есть ли в компании отдельный сотрудник для поиска и отбора кандидатов (или для работы с персоналом)?'),
(20, 'Трудно ли находить новых сотрудников в ваше предприятие?'),
(21, 'Много ли откликов на вакансию при поиске кандидата в вашу компанию?'),
(22, 'Есть ли трудности с тем, что кандидаты не доходят до собеседования?'),
(23, 'Используете ли вы хорошую технологию оценки и отбора кандидатов?'),
(24, 'Часто ли бывает, что кандидаты не проходят испытательный срок?'),
(25, 'Часто ли бывает, что сотрудники увольняются сами или по вашей инициативе проработав в компании не долго (меньше 1 года)?'),
(26, 'Есть ли у вас программы адаптации для каждого сотрудника с которой  работают системно?'),
(27, 'Есть ли в компании системная работа по наставничеству?'),
(28, 'Есть ли в компании системные подготовка и обучение сотрудников?'),
(29, 'Легко ли в компании заменить любого сотрудника, при необходимости?'),
(30, 'Вырабатывает ли компания свой потенциал по доходу? (Зарабатывает ли компания столько сколько может и должна?)');

INSERT INTO QuestionsBlocks (question_id, block_id)
VALUES
(1, 1),   
(1, 4),   
(2, 5),   
(3, 1),   
(3, 3),   
(4, 3),   
(5, 4),   
(6, 3),   
(7, 1),   
(8, 3), 
(9, 3), 
(10, 3), 
(11, 1), 
(12, 3), 
(13, 3), 
(14, 1), 
(15, 4), 
(16, 3), 
(17, 1), 
(18, 1), 
(19, 5), 
(20, 5), 
(21, 5), 
(22, 5), 
(23, 5), 
(23, 4), 
(24, 2), 
(25, 2), 
(26, 2), 
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1);

INSERT INTO Answers(id, answer_text, question_id, points)
VALUES 
(1, 'Да', 1, 0),    (31, 'Нет', 1, 1),  
(2, 'Да', 2, 0),    (32, 'Нет', 2, 1),  
(3, 'Да', 3, 0),    (33, 'Нет', 3, 1),  
(4, 'Да', 4, 1),    (34, 'Нет', 4, 0),  
(5, 'Да', 5, 1),    (35, 'Нет', 5, 0),  
(6, 'Да', 6, 1),    (36, 'Нет', 6, 0),  
(7, 'Да', 7, 1),    (37, 'Нет', 7, 0),  
(8, 'Да', 8, 1),    (38, 'Нет', 8, 0),  
(9, 'Да', 9, 1),    (39, 'Нет', 9, 0),  
(10, 'Да', 10, 1),  (40, 'Нет', 10, 0),
(11, 'Да', 11, 1),  (41, 'Нет', 11, 0),
(12, 'Да', 12, 1),  (42, 'Нет', 12, 0),
(13, 'Да', 13, 1),  (43, 'Нет', 13, 0),
(14, 'Да', 14, 1),  (44, 'Нет', 14, 0),
(15, 'Да', 15, 1),  (45, 'Нет', 15, 0),
(16, 'Да', 16, 1),  (46, 'Нет', 16, 0),
(17, 'Да', 17, 1),  (47, 'Нет', 17, 0),
(18, 'Да', 18, 1),  (48, 'Нет', 18, 0),
(19, 'Да', 19, 1),  (49, 'Нет', 19, 0),
(20, 'Да', 20, 0),  (50, 'Нет', 20, 1),
(21, 'Да', 21, 1),  (51, 'Нет', 21, 0),
(22, 'Да', 22, 0),  (52, 'Нет', 22, 1),
(23, 'Да', 23, 1),  (53, 'Нет', 23, 0),
(24, 'Да', 24, 0),  (54, 'Нет', 24, 1),
(25, 'Да', 25, 0),  (55, 'Нет', 25, 1),
(26, 'Да', 26, 1),  (56, 'Нет', 26, 0),
(27, 'Да', 27, 1),  (57, 'Нет', 27, 0),
(28, 'Да', 28, 1),  (58, 'Нет', 28, 0),
(29, 'Да', 29, 1),  (59, 'Нет', 29, 0),
(30, 'Да', 30, 1),  (60, 'Нет', 30, 0);

INSERT INTO Admins (login, password)
VALUES ('admin', '$2y$10$uYv65GFFJ5peU8A7kODs...IJVqHnmBDBMfvcU1nWLRRNFqaB10hK');

INSERT INTO ResultsTexts (result_text, block_id)
VALUES 
('Результат для блока 1 (ИПП/Тесты)', 1),
('Результат для блока 2 (ПА/курс)', 2),
('Результат для блока 3 (ЗП)', 3),
('Результат для блока 4 (Тесты)', 4),
('Результат для блока 5 (Найм + курс + все мелкие услуги)', 5);

INSERT INTO Decisions (decision_text, decision_descriprion, block_id)
VALUES 
('решение для блока 1 (ИПП/Тесты)', 'Подробнее про решение', 1),
('решение для блока 2 (ПА/курс)', 'Подробнее про решение', 2),
('решение для блока 3 (ЗП)', 'Подробнее про решение', 3),
('решение для блока 4 (Тесты)', 'Подробнее про решение', 4),
('решение для блока 5 (Найм + курс + все мелкие услуги)', 'Подробнее про решение', 5);

INSERT INTO Company_Info (phone, whats_app, tg_link)
VALUES
('+7 987 253-98-35', 'https://wa.me/+79872539835', 'https://t.me/StrongBiznes');