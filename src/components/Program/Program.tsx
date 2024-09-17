import "./Program.css";

type ProgramProps = {
  agency: string;
  visibleDate: string;
  representative: string;
  description: string;
  contact: string;
};

export const Program = ({
  agency,
  visibleDate,
  representative,
  description,
  contact,
}: ProgramProps) => {
  return (
    <div className="grid__half program-wrapper">
      <p className="typography__charlie color--blue8">{agency}</p>
      <p className="typography__echo typography--caps color--blue8">
        <b>{visibleDate}</b>
      </p>
      <p className="typography__alpha typography--light color--blue8">
        {representative}
      </p>
      <p className="typography__alpha typography--light color--neutral8">
        {description}
      </p>
      <p className="typography__alpha color--neutral8">{contact}</p>
    </div>
  );
};
