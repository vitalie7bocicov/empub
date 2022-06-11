import org.jsoup.Jsoup;
import org.jsoup.nodes.Attribute;
import org.jsoup.nodes.Attributes;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Node;

import java.util.List;

public class LinkCIDUtil {
    Document document = null;

    public void traverseHtmlTree(Node element, AttachmensDAO attachmensDAO, Mail currentMail) {
        List<Node> child = element.childNodes();

        for(Node node : child) {
            Attributes attributes = node.attributes();
            int nrChildren = node.childNodeSize();

            for(Attribute attribute : attributes) {
                String val = attribute.getValue();
                String id = null;
                if(!val.startsWith("cid:")) {
                    continue;
                }

                id = val.substring(4);
                String attachmentName = attachmensDAO.getContentName(id, currentMail.getId());
                String location = "http://localhost/TehnologiiWeb/storage/" + currentMail.getMailNumber() + '/' + attachmentName;
                attribute.setValue(location);
            }

            if(nrChildren > 0) {
                traverseHtmlTree(node, attachmensDAO, currentMail);
            }
        }

    }


    public String linkCidHtml(String html, AttachmensDAO attachmensDAO, Mail currentMail) {
        document = Jsoup.parse(html, "UTF-8");

        traverseHtmlTree(document, attachmensDAO, currentMail);
        return document.toString();
    }

}
