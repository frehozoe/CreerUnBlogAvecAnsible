#!/usr/bin/python
# -*- coding: utf-8 -*-

DOCUMENTATION='''
version: 1.0
date: 16/07/2020
module: articles
author: Fabrice
description: Module qui permet d'exécuter une requête SQL

options:
   db_name:
      description: nom de la base de données
      required: yes
   request:
      description: requête à exécuter
      required: yes

'''

EXAMPLES='''
- name: "Afficher les contenus de la table articles"
    articles:
       db_name: "ma_base"
       request: "SELECT * FROM articles;"

'''

RETURN=''''
results:
    description: retourne le résultat de la requête. 

'''

from ansible.module_utils.basic import AnsibleModule

## On définie les arguments du module
def main():
        module = AnsibleModule(
            argument_spec=dict(
                db_name = dict(required=True, type='str'),
                request = dict(required=True, type='str'),
            )
        )

        ## On récupère la valeur des arguments
        ma_base  = module.params.get('db_name')
        ma_requete  = module.params.get('request')

        import MySQLdb

        ## On se connecte à la base de données MySQL
        db = MySQLdb.connect(db=ma_base)
        cur = db.cursor()
        cur.execute(ma_requete)
        resultat = cur.fetchall()
        db.close()

        ## On transmet le résultat de la requête à Ansible
        module.exit_json(changed=False, results=resultat)

if __name__ == "__main__":
    main()

 
