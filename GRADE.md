## 🗒️ Barème :

Nuoxi Wang

| **Barème**                           | **Points**| **Remarque**                               |**Points Obtenus**|
| :-----------------------------------:| :-------: | :-------------------------------------:    |:-:|
| Entités                              |     4     |                                            | 4 |
| Fixtures                             |     2     |                                            | 2 |
| Système de traduction                |     2     |                                            | 2 |
| Formulaires                          |     5     | Tu as des champs de formulaire avec un FormType à null. Exemple DetailType.php ligne 17 et 23 tu peux mettre TextType à la place de null.| 4.5 |
| Système de connexion                 |     3     | Ton RegistrationFormType utilise un TextType pour l'email à la place d'un EmailType, je peux donc m'inscrire en mettant une chaîne de caractère classique alors que le form de login générer par le bundle me demande un email.| 2 |
| Tableau de bord                      |     2     |                                            | 2 |
| Création d'un EventCustom            |     2     |                                            | 2 |
| Code convention (points bonus)       |     2     |                                            | 2 |
| **Total**                            |   **22**  |                                            | 20.5|

## 📝 Commentaires :

Dans le fichier Game.php ligne 65 pour retourner le statut avec une Enum PHP tu pouvais faire :
```php	
return GameStatus::from($this->status);
```

Pour rendre plus agréable la navigation sur le site après une modification d'une entité redirigé vers le listing.