# Website
A small personal project based on the standard Symfony framework.  
The goal is to create a simple CMS and add functionality in the future while I'm using this for my personal website.

## Setting up
- Create a database with a user
- Run `git clone git@github.com:laetificat/website.git`
- Make sure you have either Apache or Nginx + PHP-FPM running and configured to run a Symfony project
- Run `composer install`
- Run `app/console doctrine:schema:create`
- Add a user in your users table in the database (Data fixtures coming soon!)
- Add pages, menus, menu items in the database (Data fixtures coming soon!)

## Important tasks to do
- [ ] Create data fixtures with dummy data
- [ ] Implement functionality in the backend so pages, menus, and menu items can be changed via a UI
- [ ] Make things look nice
- [ ] Add tests
- [ ] Create a Docker image
- [ ] Create an Ansible playbook
