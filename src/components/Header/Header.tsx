import { Section } from "../Section";
import "./Header.css";

export const Header = () => {
  return (
    <Section>
      <a href="/" className="logo">
        <img src="logo.svg" alt="The Hubb logo" />
      </a>

      <header className="grid grid__full--subgrid">
        <div className="grid grid__half title-wrapper">
          <h1 className="title">Helping Us Be Better</h1>
          <h2 className="subtitle">Community Resource Satellite Office</h2>
        </div>
        <nav className="links-wrapper">
          <a
            className="typography__beta typography--link color--black"
            href="/calendar"
          >
            <b> Calendar</b>
          </a>
          <a
            className="typography__beta typography--link color--black"
            href="/programming"
          >
            <b> Programming </b>
          </a>
        </nav>
      </header>
    </Section>
  );
};
