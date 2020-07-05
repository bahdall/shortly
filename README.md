
# URL Shortly
## Описание 
Сервис для сокращения пользовательских ссылок. 

## Установка 
 
1. Клонировать репозиторий : `git clone https://github.com/bahdall/shortly.git`
2. Перейти в папку проекта: `cd shortly`
3. Скопировать .env файл: `cp .env.example .env`
4. Выполнить команды:
```bash
make up
make composer-install
make artisan-key-generate
make artisan-migrate
```
5. Сгенерировать токент для доступа к созданию ссылок: ```make artisan-token-generate```

## Методы

### CreateLinks
Создает сокращенную ссылку

**Uri: '/'**

**Method: POST**

***HEADER[TOKEN]** - Необходимо передавать токен в заголовке


**Принимаемые параметры:**

| Название  | Тип  | Значение по умолчанию  | Описание |
| ------------ | ------------ | ------------ | ------------ |
| ***url**  | string  | -  | Ссылка на ресурс |

**Возвращаемые данные:**

| Название  | Тип  | Значение по умолчанию  | Описание |
| ------------ | ------------ | ------------ | ------------ |
| url  | string  | -  | Сокращенная ссылка |

**Пример запроса:**

```bash
curl --location --request POST 'http://localhost/' \
--header 'TOKEN: 40a4d8f309fb4516aee28c6517a846b6' \
--header 'Content-Type: application/json' \
--data-raw '{
	"url": "https://yandex.ru/"
}'
```

### RedirectToUrl
Перенаправляет пользователя на указанный при создании ресурс

**Uri: '/{hash}'**

**Method: GET**

**RESPONSE CODE: 302**

**Пример запроса:**

```bash
curl --location --request GET 'http://localhost/30b7df27e9f842b33cf9e517c98a075e' 
```


