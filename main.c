
#include "graph.h"

#define MAX_PERSONNES 100

int main(void)
{
  // Partie I
  T_graph *g1 = newGraph(4);

  addEdge(g1, 1, 2, 0.75);
  addEdge(g1, 1, 3, 0.54);
  addEdge(g1, 2, 3, 0.24);
  addEdge(g1, 3, 4, 0.81);
  addEdge(g1, 4, 1, 0.37);
  addEdge(g1, 4, 2, 0.98);

  showGraph(g1);
  createDotPOT(g1, "G1");
  

  // Partie II
  char *tabPersonne[MAX_PERSONNES];
  float tabConfiance[MAX_PERSONNES];

  T_graph *g2;
 
  load("reseau.txt", tabPersonne, &g2);

  showGraph_V2(g2, tabPersonne);

  dumpGraph_V2(stdout, g2, tabPersonne);

  createDotPOT_V2(g2, "G2", tabPersonne);

  // Calcul de la valeur de confiance entre A et B
  personTrust(1, 4, tabConfiance, g2);
  //showTab(tabPersonne, tabConfiance, 1, g2->nbSommets);

  return 0;
}
