# language: fr
Fonctionnalité: Fonctionnalité Connexion
  Scénario: Se connecter
    Etant donné que j'ajoute l'entête "Content-Type" égale à "application/json"
    Lorsque j'envoie une requête "GET" sur "/api/login_check"
    Alors le code de status de la réponse devrait être 200

