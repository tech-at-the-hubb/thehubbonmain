import type { Document as RichTextDocument } from "@contentful/rich-text-types";

import { documentToReactComponents } from "@contentful/rich-text-react-renderer";

import { Section } from "../Section";
import "./Footer.css";

type FooterProps = {
  fieldLeft: RichTextDocument;
  fieldRight: RichTextDocument;
};

export const Footer = ({ fieldLeft, fieldRight }: FooterProps) => {
  return (
    <Section classNames={["footer"]}>
      <div className="grid grid__full--subgrid">
        <div className="grid grid__half">
          <div className="typography__echo">
            {documentToReactComponents(fieldLeft)}
          </div>

          <p className="typography__echo">
            To contact The Hubb directly please email{" "}
            <a href="mailto:info@thehubbonmain.org">info@thehubbonmain.org</a>
          </p>

          <a
            className="typography__echo"
            href="https://mailchi.mp/9e695de79495/hubb-newsletter-signup-form"
            target="_blank"
            rel="noreferrer"
          >
            Subscribe to email updates
          </a>

          <div className="social-icons">
            <a
              href="https://www.facebook.com/profile.php?id=61550649696448"
              target="_blank"
              rel="noreferrer"
            >
              <img src="fb.svg" alt="Facebook logo" />
            </a>
            <a
              href="https://www.instagram.com/thehubbonmain/"
              target="_blank"
              rel="noreferrer"
            >
              <img src="insta.svg" alt="Instagram logo" />
            </a>
          </div>
        </div>
        <div className="grid grid__half">
          <div className="typography__echo">
            {documentToReactComponents(fieldRight)}
          </div>
        </div>
      </div>
    </Section>
  );
};
