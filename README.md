# Task

- Register a Zoho CRM trial account;
- Using Laravel:
- Connect via Zoho CRM API;
- Create an entry in the Contacts module in Zoho CRM;
- Create an entry in the Deals (Potentials) module associated with an entry in Contacts.


## Result
! Docker require
- clone project
- run
```
cmd: composer update
```
- rename and fill env.example file to .env
```
ZOHO_CLIENT_ID=
ZOHO_CLIENT_SECRET=
ZOHO_CURRENT_USER_EMAIL=
ZOHO_TOKEN=
```
- run command
```
cmd: php artisan key:generate
cmd: sail up -d
```
- open your browser and fill the address http://localhost:8000  


![Home page](/Screenshot_home.png)
### Add contact page
![Add contact page](/Screenshot_add_contact.png)
### Add deal page
![Add deal page](/Screenshot_create_deal.png)
### Tests
![Tests](/Screenshot_tests.png)
