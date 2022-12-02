Stylesheets:

Public>assets>admin - for admin dashboard
Public>assets>client - donor and visitor dashboard 
Public>assets>print - invoice Stylesheets

=======================================
Routes:

routes>admin - admin and staff routes
routes>donor - donor routes
routes>visitor - visitor routes
routes>hospital - hospital routes

================================================
backend functions:

app>http>controllers>admin>auth - admin and staff authentication methods 
app>http>controllers>donor>auth - donor authentication methods 
app>http>controllers>hospital>auth - hospital authentication methods 


app>http>controllers>admin - all admin methods
app>http>controllers>admin/staff - all staff methods
app>http>controllers>donor - all donor methods
app>http>controllers>hospital - all hospital methods
app>http>controllers>visitor - all visitor methods

=================================================
Mail Constructors:

app>mail>admin - all mails sent by admin
app>mail>donor - all mails sent to donor
app>mail>hospital - all mails sent by hospital
app>mail>staff - all mails sent by staff
app>mail>visitor - all mails sent to visitor

================================================
Database structure:

database>migrations - all datatables structures
database>seeders - seeding data for initial record of admin table

artisan command: php artisan db:seed

================================================

