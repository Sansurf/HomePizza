# HomePizza

Все запросы к БД у меня выведены в модель model/M_DriverDB.php,
в архиве имеется дамп БД

Базовый контроллер C_Base наследуется от C_Controller,
в C_Controller формируется шаблон приложения,
а C_Base взаимодействует с моделью.

От C_Base наследуются два контроллера,
AdminController предназначен для добавления,
редактирования и удаления записей.
ClientController для просмотра
