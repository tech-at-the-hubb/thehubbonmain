export interface Node {
  data: {};
  marks?: Mark[];
  value?: string;
}

export interface Field {
  content: Node[];
}

export interface Entry {
  [key: string]: Field;
}

type Mark = { type: string };
