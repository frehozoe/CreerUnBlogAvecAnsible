# CreerUnBlogAvecAnsible
L'objectif de ce projet est de **créer un simple module Ansible**, écrit en Python, pour gérer une base de données d'un blog. Pour faire fonctionner le blog et de tester le bon fonctionnement de ce module Ansible, vous avez besoin d'installer un stack LAMP (Linux Apache MySQL PHP). L'installation de ce stack LAMP sera automatiser à l'aide d'Ansible.


# PRE-REQUIS
1. Avoir installé 03 machines Linux : Ubuntu ou Debian 
    * **node-manager** : permet de gérer les deux nodes via SSH pour y pousser les scripts de config.
    * **node-1** : membre du groupe **web-server**, où Apache et PHP seront installés.
    * **node-2** : membre du groupe **db**, où la base de données MySQL sera installé.

2. **Ansible** doit être installé au préalable et **uniquement** sur **`node-manager`**.
3. Vérifier si **Python 2 ou 3** est bien installé sur les nodes.
4. Définir un **inventaire** des nodes.
5. Vérifier la **connexion SSH** entre le node-manager et les nodes.
6. Tester un **PING** avec Ansible sur les nodes.
7. Créer un **utilisateur Ansible non-root** sur les nodes.
8. L'utilisateur Ansible doit avoir le droit **"sudo"** sur tous les nodes.
9. Générer **une paire de clés SSH** pour cet utilisateur. 
10. Copier la **clé publique** sur tous les nodes.


# FONCTIONNEMENT
* Le playbook **`lamp_playbook.yml`** : permet de déployer automatiquement le stack LAMP sur les nodes. Puis, crée la base de données et la table nécessaire pour le blog.
* Le playbook **`module_playbook.yml`**: permet de lancer le module **"library/articles.py"**


# DEPLOIMENT

# 1. Stack LAMP

_// Connectez-vous, sur **`node-manager`**, en tant que utilisateur Ansible_ 
```
ssh user-ansible@node-manager
```

_// Activez l'**`environnement virtuel` Ansible**, en tapant la commande suivante :_
```
source ansible2.9.10/bin/activate
```
_// Téléchargez ce projet CreerUnBlogAvecAnsible_
```
sudo mkdir downloads
cd downloads
sudo wget https://github.com/frehozoe/CreerUnBlogAvecAnsible/archive/master.zip
```

_// Dézippez le dossier **master.zip**. N'hésitez pas à installer **unzip** s'il n'existe pas, en faisant : **"sudo apt install unzip -y"**_
```
sudo unzip master.zip
```

_// Lancez le déploiement du stack LAMP_
```
cd CreerUnBlogAvecAnsible-master/lamp-server/
ansible-playbook lamp_playbook.yml
```

Désormais, si tout s'est bien déroulé, le stack LAMP est installé. La base de données et la table sont créées et le blog est opérationnel.


_// **Testez et créez votre premier article**, en tapant l'adresse **IP du serveur web** dans navigateur._
```
http://IP-du-node-1
```

# 2. Module Ansible : "articles.py"

Le module Ansible se trouve dans le dossier **"library/"**.

_// Pour savoir le nombres d'articles crées ou publiés, taper la commande suivante :_
```
ansible-playbook -i inventaire.ini module_playbook.yml -K -b
```
