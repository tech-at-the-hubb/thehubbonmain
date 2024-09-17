import type { Document as RichTextDocument } from "@contentful/rich-text-types";

import { documentToReactComponents } from "@contentful/rich-text-react-renderer";

import { Section } from "../Section";
import "./CTA.css";

type CTAProps = {
  field: RichTextDocument;
};

export const CTA = ({ field }: CTAProps) => {
  return (
    <Section classNames={["CTA"]}>
      <div className="grid grid__full--subgrid">
        <div className="grid grid__half">
          <div className="typography__alpha">
            {documentToReactComponents(field)}
          </div>
        </div>
        <div className="grid grid__half">
          <a
            className="button"
            href="https://thehubb.betterworld.org/donate"
            target="blank"
          >
            <b className="typography__alpha typography--caps">Donate now!</b>
          </a>
        </div>
      </div>
    </Section>
  );
};
