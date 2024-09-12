import type { ReactNode } from "react";

import "./Section.css";

type SectionProps = {
  classNames?: string[];
  children: ReactNode;
};

export const Section = ({ classNames = [], children }: SectionProps) => {
  return (
    <section className={["section", ...classNames].join(" ")}>
      <div className="grid grid__fullplus">{children}</div>
    </section>
  );
};
