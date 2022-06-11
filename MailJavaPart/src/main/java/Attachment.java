public class Attachment {
    private int id;
    private String name;
    private String contentID;
    private int mailID;
    private String relation;

    public Attachment() {
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getContentID() {
        return contentID;
    }

    public void setContentID(String contentID) {
        this.contentID = contentID;
    }

    public int getMailID() {
        return mailID;
    }

    public void setMailID(int mailID) {
        this.mailID = mailID;
    }

    public String getRelation() {
        return relation;
    }

    public void setRelation(String relation) {
        this.relation = relation;
    }
}
