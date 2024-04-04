#include "../include/check.h"
#include "../include/traces.h"
#include "graph.h"

#define BUFFER_SIZE 1024

char *outputPath = "./";

// PARTIE I
/*
Entrée(s) : c (int)
Sortie : T_graph *
Description : Crée un nouveau graphe
*/
T_graph *newGraph(int c)
{
	T_graph * g;
	int i;
	g = (T_graph *) malloc( sizeof(T_graph) );
	g->nbSommets = c;
	g->tAdj = (T_list *)malloc(c * sizeof(T_list));
	for (i = 0; i < c; i++) g->tAdj[i] = NULL;
	return g;
}

/*
Entrée(s) : s (int), p (int), pNext (T_node *)
Sortie : T_node *
Description : Crée un nouveau noeud
*/
T_node *newNode(int s, float p, T_node *pNext) {
	T_node *n;
	n = (T_node *)malloc(sizeof(T_node));
	n->noSommets = s;
	n->poids = p;
	n->pNext = pNext;
	return n;
}

/*
Entrée(s) : dest (int), p (int), head (T_list)
Sortie : T_list
Description : Ajoute un noeud à la liste
*/
T_list addNode(int dest, float p, T_list head) {
	T_node *n;
	n = newNode(dest, p, head);
	return n;
}

/*
Entrée(s) : g (T_graph *), org (int), dest (int), p (float)
Sortie : void
Description : Ajoute une arête entre deux sommets
*/
void addEdge(T_graph *g, int org, int dest, float p)
{
    T_node *n;
    n = addNode(dest, p, g->tAdj[org]);
    g->tAdj[org] = n;
}

/*
Entrée(s) : g (T_graph *), org (int), dest (int)
Sortie : void
Description : Supprime une arête entre deux sommets
*/
void removeEdge(T_graph *g, int org, int dest)
{
    T_node *n, *prev;
    n = g->tAdj[org];
    prev = NULL;
    while (n != NULL && n->noSommets != dest)
    {
        prev = n;
        n = n->pNext;
    }
    if (n != NULL)
    {
        if (prev == NULL)
            g->tAdj[org] = n->pNext;
        else
            prev->pNext = n->pNext;
        free(n);
    }
}

/*
Entrée(s) : g (T_graph *)
Sortie : void
Description : Affiche le graphe
*/
void showGraph(T_graph *g)
{
    T_node *n;
    for (int i = 0; i < g->nbSommets+1; i++)
    {
        n = g->tAdj[i];
        while (n != NULL)
        {
            printf("%d->(%.2f)->%d\n", i, n->poids, n->noSommets);
            n = n->pNext;
        }
    }
}

/*  
Entrée(s) : fp (FILE *), g (T_graph *)
Sortie : void
Description : Affiche la structure du graphe
*/
void dumpGraph(FILE *fp, T_graph *g)
{
    T_node *n;
    for (int i = 0; i < g->nbSommets+1; i++)
    {
        n = g->tAdj[i];
        while (n != NULL)
        {
            fprintf(fp, "%d -> %d [label=\"%.2f\"];\n", i, n->noSommets, n->poids);
            n = n->pNext;
        }
    }

}

/*
Entrée(s) : g (T_graph *), basename (const char *)
Sortie : void
Description : Crée un fichier .dot et un fichier .png
*/
void createDotPOT(T_graph *g, const char *basename)
{
	static char oldBasename[FILENAME_MAX + 1] = "";
	static unsigned int noVersion = 0;

	char DOSSIER_DOT[FILENAME_MAX + 1]; 
	char DOSSIER_PNG[FILENAME_MAX + 1]; 

	char fnameDot [FILENAME_MAX + 1];
	char fnamePng [FILENAME_MAX + 1];
	char	cmdLine [2 * FILENAME_MAX + 20];
	FILE *fp;
	struct stat sb;
	

	// Au premier appel, création (si nécessaire) des répertoires
	// où seront rangés les fichiers .dot et .png générés par cette fonction	

	// il faut créer le répertoire outputPath s'il n'existe pas 
	if (stat(outputPath, &sb) == 0 && S_ISDIR(sb.st_mode)) {
    } else {
        printf("Création du répertoire %s\n", outputPath);
		mkdir(outputPath, 0777);
    }

	// il faut créer les répertoires outputPath/png et /dot 
	sprintf(DOSSIER_DOT, "%s/dot/",outputPath);
	sprintf(DOSSIER_PNG, "%s/png/",outputPath);

	if (oldBasename[0] == '\0') {
		mkdir(DOSSIER_DOT,	S_IRWXU | S_IRGRP | S_IXGRP | S_IROTH | S_IXOTH);
		mkdir(DOSSIER_PNG,	S_IRWXU | S_IRGRP | S_IXGRP | S_IROTH | S_IXOTH);
	}

	 // S'il y a changement de nom de base alors recommencer à zéro
	 // la numérotation des fichiers 

	if (strcmp(oldBasename, basename) != 0) {
		noVersion = 0;
		strcpy(oldBasename, basename); 
	}

	sprintf(fnameDot, "%s%s_v%02u.dot", DOSSIER_DOT, basename, noVersion);
	sprintf(fnamePng, "%s%s_v%02u.png", DOSSIER_PNG, basename, noVersion);

	CHECK_IF(fp = fopen(fnameDot, "w"), NULL, "erreur fopen dans saveDotBST"); 
	
	noVersion ++;
	
	fprintf(fp, "digraph graphe {\n");
	fprintf(fp, "rankdir = LR;\n");
	for (int i = 1; i < g->nbSommets+1; i++) {
			fprintf(fp, "%d [fontname=\"Arial\", shape = circle, color=lightblue, style=filled];\n", i);
		
	}
	
	fprintf(fp, "edge [color=red];\n");
	
	// et appel de la fonction dumpGraphMD
	dumpGraph(fp, g);
	
	
	fprintf(fp, "}\n");	
		
	fclose(fp);

	sprintf(cmdLine, "dot -Tpng  %s -o %s", fnameDot, fnamePng);
	system(cmdLine);

	printf("Creation de '%s' et '%s' ... effectuee\n", fnameDot, fnamePng);
}

/*
Entrée(s) : g (T_graph *)
Sortie : T_graph *
Description : Supprime le graphe
*/
T_graph *deleteGraph(T_graph *g)
{
	T_node *n, *next;
	for (int i = 0; i < g->nbSommets+1; i++)
	{
		n = g->tAdj[i];
		while (n != NULL)
		{
			next = n->pNext;
			free(n);
			n = next;
		}
	}
	free(g->tAdj);
	free(g);
	return NULL;
}

// PARTIE II
/*
Entrée(s) : fp (FILE *), tabPersonne (char **)
Sortie : int
Description : Charge le tableau de personnes
*/
int loadTabPersonne(FILE *fp, char **tabPersonne)
{
	char buffer[BUFFER_SIZE];
	int i = 0;
	fgets(buffer, BUFFER_SIZE, fp);

	char *token = strtok(buffer, ";");
	while (token != NULL)
	{
		tabPersonne[i] = (char *)malloc(strlen(token) + 1);
		strcpy(tabPersonne[i], token);
		token = strtok(NULL, ";");
		i++;
	}
	return i;
}

/*
Entrée(s) : fp (FILE *), g (T_graph *)
Sortie : void
Description : Charge le graphe
*/
void loadGraph(FILE *fp, T_graph *g)
{
	char buffer[BUFFER_SIZE];
	int org, dest;
	float p;
	
	while (fgets(buffer, BUFFER_SIZE, fp) != NULL)
	{
		sscanf(buffer, "%d;%d;%f", &org, &dest, &p);
		addEdge(g, (int) org, (int) dest, (float) p);
	}
}

/*
Entrée(s) : filename (const char *), tabPersonne (char **), g (T_graph **)
Sortie : void
Description : Charge le tableau de personnes et le graphe
*/
void load(const char *filename, char **tabPersonne, T_graph **g)
{
	/*
	Cette fonction permet de charger le tableau de personnes
	et le graphe à partir du fichier reseau.txt.
	*/
	FILE *fp = fopen(filename, "r");
	if (fp == NULL)
	{
		perror("fopen");
		exit(1);
	}
	int n = loadTabPersonne(fp, tabPersonne);
	*g = newGraph(n);
	loadGraph(fp, *g);
	fclose(fp);
}

/*
Entrée(s) : tabPersonne (char **), tabConfiance (float *), org (int), g (T_graph *)
Sortie : void
Description : Calcule la confiance
*/
void showGraph_V2(T_graph *g, char **tabPersonne)
{
	T_node *n;
	for (int i = 0; i < g->nbSommets+1; i++)
	{
		n = g->tAdj[i];
		while (n != NULL)
		{
			printf("%s->(%.2f)->%s\n", tabPersonne[i-1], n->poids, tabPersonne[n->noSommets-1]);
			n = n->pNext;
		}
	}
}

/*
Entrée(s) : fp (FILE *), g (T_graph *), tabPersonne (char **)
Sortie : void
Description : Affiche la structure du graphe
*/
void dumpGraph_V2(FILE *fp, T_graph *g, char **tabPersonne)
{
	T_node *n;
	for (int i = 0; i < g->nbSommets+1; i++)
	{
		n = g->tAdj[i];
		while (n != NULL)
		{
			fprintf(fp, "%s -> %s [label=\"%.2f\"];\n", tabPersonne[i-1], tabPersonne[n->noSommets-1], n->poids);
			n = n->pNext;
		}
	}
}

void createDotPOT_V2(T_graph *g, const char *basename, char **tabPersonne)
{
	static char oldBasename[FILENAME_MAX + 1] = "";
	static unsigned int noVersion = 0;

	char DOSSIER_DOT[FILENAME_MAX + 1]; 
	char DOSSIER_PNG[FILENAME_MAX + 1]; 

	char fnameDot [FILENAME_MAX + 1];
	char fnamePng [FILENAME_MAX + 1];
	char	cmdLine [2 * FILENAME_MAX + 20];
	FILE *fp;
	struct stat sb;
	

	// Au premier appel, création (si nécessaire) des répertoires
	// où seront rangés les fichiers .dot et .png générés par cette fonction	

	// il faut créer le répertoire outputPath s'il n'existe pas 
	if (stat(outputPath, &sb) == 0 && S_ISDIR(sb.st_mode)) {
	} else {
		printf("Création du répertoire %s\n", outputPath);
		mkdir(outputPath, 0777);
	}

	// il faut créer les répertoires outputPath/png et /dot 
	sprintf(DOSSIER_DOT, "%s/dot/",outputPath);
	sprintf(DOSSIER_PNG, "%s/png/",outputPath);

	if (oldBasename[0] == '\0') {
		mkdir(DOSSIER_DOT,	S_IRWXU | S_IRGRP | S_IXGRP | S_IROTH | S_IXOTH);
		mkdir(DOSSIER_PNG,	S_IRWXU | S_IRGRP | S_IXGRP | S_IROTH | S_IXOTH);
	}

	 // S'il y a changement de nom de base alors recommencer à zéro
	 // la numérotation des fichiers 

	if (strcmp(oldBasename, basename) != 0) {
		noVersion = 0;
		strcpy(oldBasename, basename); 
	}

	sprintf(fnameDot, "%s%s_v%02u.dot", DOSSIER_DOT, basename, noVersion);
	sprintf(fnamePng, "%s%s_v%02u.png", DOSSIER_PNG, basename, noVersion);

	CHECK_IF(fp = fopen(fnameDot, "w"), NULL, "erreur fopen dans saveDotBST"); 
	
	noVersion ++;
	
	fprintf(fp, "digraph graphe {\n");
	fprintf(fp, "rankdir = LR;\n");
	for (int i = 1; i < g->nbSommets; i++) {
			fprintf(fp, "%s [fontname=\"Arial\", shape = circle, color=lightblue, style=filled];\n", tabPersonne[i-1]);
		
	}

	fprintf(fp, "edge [color=red];\n");

	// et appel de la fonction dumpGraph
	dumpGraph_V2(fp, g, tabPersonne);

	fprintf(fp, "}\n");

	fclose(fp);

	sprintf(cmdLine, "dot -Tpng  %s -o %s", fnameDot, fnamePng);
	system(cmdLine);

	printf("Creation de '%s' et '%s' ... effectuee\n", fnameDot, fnamePng);
}

void personTrust(int org, int dest, float *tabConfiance, T_graph *g)
{	
	/*
	Etape 0, le tableau tabConfiance est initialisé à 1 pour le nœud 1 et à 0 pour tous les autres nœuds. 
	
	Etape 1, nous allons explorer les voisins directs du nœud 1 pour lesquels nous n’avons pas une valeur de 
	confiance (nœud 2 et 3) et nous allons mettre à jour tabConfiance. Les nouvelles valeurs de confiance 
	pour les nœuds 2 et 3 sont calculé en prenant en compte la valeur de la confiance du prédécesseur de 2 et 
	3 (dans cette étape le prédécesseur est le nœud 1). Ce qui nous donne :  
	confiance(1,2) = confiance(1,1) x confiance(1,2) = 1 x 0.75 = 0.75 
	confiance(1,3) = confiance(1,1) x confiance(1,3) = 1 x 0.54 = 0.54 
	
	Etape 2, dans cette étape il n’y pas de voisins directs du nœud 2 pour lesquels nous n’avons pas de valeurs 
	de confiance dans tabConfiance. 
	
	Etape 3, il y a un seul voisin direct inconnu du nœud 3, c’est le nœud 4. Nous obtenons : 
	confiance(1,4) = confiance(1,3) x confiance(3,4) = 0.54 x 0.81 = 0.44 

	*/

	printf("Calcul de la confiance entre %d et %d\n", org, dest);

	//Etape 0
	for (int i = 0; i < g->nbSommets; i++)
		tabConfiance[i] = 0;
	tabConfiance[org] = 1;
	
	//Etape 1

	
	//Etape 2

	//Etape 3
	


}

void showTab(char **tabPersonne, float *tabConfiance, int org, int n)
{
    for (int i = 0; i < n; i++)
        if (tabConfiance[i] != 0)
            printf("%s->(%.2f)->%s\n", tabPersonne[org], tabConfiance[i], tabPersonne[i]);
}