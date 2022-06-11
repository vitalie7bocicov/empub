public class Tags {
    private String password;
    private String duration;
    private String from;
    private String to;
    private String subject;
    private String date;

    public Tags(String password, String duration, String from, String to, String subject, String date) {
        this.password = password;
        this.duration = duration;
        this.from = from;
        this.to = to;
        this.subject = subject;
        this.date = date;
    }

    public String getPassword() {
        return password;
    }

    public String getDuration() {
        return duration;
    }

    public String getFrom() {
        return from;
    }

    public String getTo() {
        return to;
    }

    public String getSubject() {
        return subject;
    }

    public String getDate() {
        return date;
    }
}
