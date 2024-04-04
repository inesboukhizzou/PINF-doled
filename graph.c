
void personTrust(int org, int dest, float *tabConfiance, T_graph *g)
{
    // Initialisation du tableau de confiance
    for (int i = 0; i < g->n+1; i++) {
        tabConfiance[i] = 0; // Initialise toutes les confiances à 0
    }
    tabConfiance[org] = 1; // La confiance de l'origine est mise à 1

    // File pour effectuer un parcours en largeur d'abord
    int *file = (int *)malloc(g->n * sizeof(int));
    int debut = 0;
    int fin = 0;

    // Ajout de l'origine dans la file
    file[fin++] = org;

    // Parcours en largeur d'abord
    while (debut != fin) {
        // On retire le premier élément de la file
        int noeudCourant = file[debut++];

        // On parcourt les voisins du noeud courant
        T_node *voisin = g->s[noeudCourant];
        while (voisin != NULL) {
            // Si le voisin n'a pas encore de confiance définie
            if (tabConfiance[voisin->noSommets] == 0) {
                // On calcule la confiance du voisin en multipliant la confiance actuelle par le poids de la relation
                tabConfiance[voisin->noSommets] = tabConfiance[noeudCourant] * voisin->poids;
                // On ajoute le voisin à la file pour explorer ses voisins par la suite
                file[fin++] = voisin->noSommets;
            }
            voisin = voisin->pNext;
        }
    }

    // Libération de la mémoire allouée pour la file
    free(file);

    //on affiche le tableau de confiance
    for (int i = 1; i < g->n+1; i++) {
        if (tabConfiance[i] != 0) {
            printf("%d->(%.2f)->%d\n", org, tabConfiance[i], i);
        }
    }
}
