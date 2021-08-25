<?php

$route = new Route();

//HOME
$route->set('index.php', function (){
    $frontend = new FrontendController();
    return $frontend->index();
});
//CACHING - MEMCACHE
$route->set('users-cache', function (){
    $frontend = new FrontendController();
    return $frontend->usersCache();
});

//LOGIN
$route->set('login', function (){
    $login = new LoginController();
    return $login->login();
});
//LOGOUT
$route->set('logout', function (){
    $login = new LoginController();
    return $login->logout();
});
//USER - PROFILE
$route->set('user-profile', function (){
    $user = new UserController();
    return $user->userProfile();
});
//USERS - CREATE FORM
$route->set('create', function (){
    $user = new UserController();
    return $user->create();
});
//USERS - INSERT
$route->set('store', function (){
    $user = new UserController();
    return $user->store();
});
//SEND REQUEST USER
$route->set('send-request', function (){
    $user = new UserController();
    return $user->sendRequest();
});
//USER - UPDATE PASSWORD FORM
$route->set('update-password-form', function (){
    $user = new UserController();
    return $user->updatePasswprdForm();
});
//USER - UPDATE PASSWORD
$route->set('update-password', function (){
    $user = new UserController();
    return $user->updatePassword();
});
//USER - UPDATE FORM
$route->set('update-from', function (){
    $user = new UserController();
    return $user->updateForm();
});
//USER - UPDATE
$route->set('update-profile', function (){
    $user = new UserController();
    return $user->updateProfile();
});
//USER - CONTROL VIEW
$route->set('control-view', function (){
    $user = new UserController();
    return $user->controlView();
});
//USER - BAN
$route->set('ban-user', function (){
    $user = new UserController();
    return $user->banUser();
});
//USER - VERIFICATION LINK
$route->set('verification', function (){
    $user = new UserController();
    return $user->verification();
});
//USER - CONFIRMATION
$route->set('confirm', function (){
    $user = new UserController();
    return $user->confirmVerification();
});
//USER - UNBAN
$route->set('unban-user', function (){
    $user = new UserController();
    return $user->unbunUser();
});
//CONTACTS - REQUESTS
$route->set('requests-all', function (){
    $contact = new ContactController();
    return $contact->requests();
});

//CONTACTS - DECLINE
$route->set('decline', function (){
    $contact = new ContactController();
    return $contact->declineRequest();
});
//CONTACTS - GET CONTACTS
$route->set('contacts-all', function (){
    $contact = new ContactController();
    return $contact->getAllContacts();
});
//CONTACT - ADD CONTACTS
$route->set('add-contact', function (){
    $contact = new ContactController();
    return $contact->addContact();
});

//CONTACT - ADD FAVORITES CONTACT
$route->set('add-favorites', function (){
    $favorite = new FavoriteController();
    return $favorite->addFavorites();
});
//CONTACT - GET FAVORITES
$route->set('favorites-contact', function (){
    $favorite = new FavoriteController();
    return $favorite->getFavorites();
});
//CONTACT - KICK CONTACT
$route->set('kick-contacts', function (){
    $contact = new ContactController();
    return $contact->kickContact();
});
//CONTACT - KICK FAVORITES
$route->set('kick-favorites', function (){
    $favorite = new FavoriteController();
    return $favorite->kickFavorites();
});

//RESET PASSWORD - FORM
$route->set('reset-password-form', function (){
    $login = new LoginController();
    return $login->resetPasswordForm();
});
//RESET PASSWORD - FORM FOR NEW
$route->set('reset_new_password_form', function (){
    $login = new LoginController();
    return $login->resetNewPasswordForm();
});

//RESET PASSWORD
$route->set('reset-request', function (){
    $login = new LoginController();
    return $login->resetPassword();
});
//RESET PASSWORD - NEW PASSWORD
$route->set('create-new-password', function (){
    $login = new LoginController();
    return $login->createNewPassword();
});

//MESSAGES - VIEW
$route->set('messages-view', function (){
    $message = new MessageController();
    return $message->messages();
});
//MESSAGES - SEND MESSAGE
$route->set('send-message', function (){
    $message = new MessageController();
    return $message->sendMessage();
});
//MESSAGES - DELETE
$route->set('delete-message', function (){
    $message = new MessageController();
    return $message->deleteMessage();
});
//MESSAGES = UPDATE FORM
$route->set('update-message-form', function (){
    $message = new MessageController();
    return $message->showCommentForEdit();
});
//MESSAGES - UPDATE
$route->set('update-message', function (){
    $message = new MessageController();
    return $message->updateMessage();
});

//OBSERVER - DP
$route->set('obs', function (){
    $obs = new FrontendController();
    return $obs->obs();
});

//404
$route->set('not-found', function (){
    $error = new ErrorController();
    return $error->notFound();
});



